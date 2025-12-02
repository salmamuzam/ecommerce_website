<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartService
{
    /**
     * Add a product to the cart.
     *
     * @param int $productId
     * @return array
     */
    public function addToCart(int $productId): array
    {
        $product = Product::find($productId);

        if (!$product) {
            return ['status' => 'error', 'message' => 'Product not found.'];
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity']++;
        } else {
            $cart[$productId] = [
                'title' => $product->title,
                'price' => $product->price,
                'quantity' => 1,
                'image' => $product->image,
                'description' => $product->description,
            ];
        }

        session()->put('cart', $cart);

        return ['status' => 'success', 'message' => 'Product added to cart successfully!'];
    }

    /**
     * Remove a product from the cart.
     *
     * @param int $productId
     * @return void
     */
    public function removeFromCart(int $productId): void
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session()->put('cart', $cart);
        }
    }

    /**
     * Update the quantity of a product in the cart.
     *
     * @param int $productId
     * @param int $quantity
     * @return void
     */
    public function updateQuantity(int $productId, int $quantity): void
    {
        if ($quantity <= 0) {
            $this->removeFromCart($productId);
            return;
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] = $quantity;
            session()->put('cart', $cart);
        }
    }

    /**
     * Calculate the total price of the cart.
     *
     * @return float
     */
    public function calculateTotal(): float
    {
        $cart = session()->get('cart', []);

        return array_reduce($cart, function ($carry, $item) {
            return $carry + ($item['price'] * $item['quantity']);
        }, 0);
    }

    /**
     * Create an order from the current cart.
     *
     * @return array
     */
    public function createOrder(): array
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return ['status' => 'error', 'message' => 'Cart is empty. Add products to confirm an order.'];
        }

        $orderTotal = 0;

        foreach ($cart as $productId => $item) {
            $productTotal = $item['price'] * $item['quantity'];
            $orderTotal += $productTotal;

            Order::create([
                'product_id' => $productId,
                'user_id' => Auth::id(),
                'quantity' => $item['quantity'],
                'price_per_item' => $item['price'],
                'total_price' => $productTotal,
                'status' => \App\Enums\OrderStatus::PENDING,
            ]);
        }

        session()->forget('cart');

        return [
            'status' => 'success',
            'message' => "Order placed successfully! Your total is $orderTotal. We will notify you once it is approved.",
            'total' => $orderTotal
        ];
    }

    /**
     * Sync missing details (description, image) for cart items.
     *
     * @return void
     */
    public function syncCartDetails(): void
    {
        $cart = session()->get('cart', []);
        $updated = false;

        foreach ($cart as $id => $item) {
            if (!isset($item['description']) || !isset($item['image'])) {
                $product = Product::find($id);
                if ($product) {
                    if (!isset($item['description'])) {
                        $cart[$id]['description'] = $product->description;
                    }
                    if (!isset($item['image'])) {
                        $cart[$id]['image'] = $product->image;
                    }
                    $updated = true;
                }
            }
        }

        if ($updated) {
            session()->put('cart', $cart);
        }
    }
}
