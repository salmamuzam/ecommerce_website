<?php

namespace App\Livewire;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CartComponent extends Component
{
    public $cart = [];

    public $total = 0;

    public function mount()
    {
        $this->cart = session()->get('cart', []);

        // Sync missing details (description, image)
        $updated = false;
        foreach ($this->cart as $id => $item) {
            if (!isset($item['description']) || !isset($item['image'])) {
                $product = \App\Models\Product::find($id);
                if ($product) {
                    if (!isset($item['description'])) {
                        $this->cart[$id]['description'] = $product->description;
                    }
                    if (!isset($item['image'])) {
                        $this->cart[$id]['image'] = $product->image;
                    }
                    $updated = true;
                }
            }
        }

        if ($updated) {
            session()->put('cart', $this->cart);
        }

        $this->calculateTotal();
    }

    public function removeFromCart($productId)
    {

        if (isset($this->cart[$productId])) {

            unset($this->cart[$productId]);

            session()->put('cart', $this->cart);

            $this->calculateTotal();
            $this->dispatch('cart-alert', type: 'success', message: 'Product removed from cart.');
        }
    }


    public function updateQuantity($productId, $quantity)
    {
        if ($quantity <= 0) {
            $this->removeFromCart($productId);
        } elseif (isset($this->cart[$productId])) {
            $this->cart[$productId]['quantity'] = $quantity;
            session()->put('cart', $this->cart);
            $this->calculateTotal();
            $this->dispatch('cart-alert', type: 'success', message: 'Cart updated successfully.');
        }
    }

    public function confirmOrder()
    {

        if (empty($this->cart)) {

            session()->flash('error', 'Cart is empty. Add products to confirm an order.');

            return;

        }

        $orderTotal = 0;

        foreach ($this->cart as $productId => $item) {

            $productTotal = $item['price'] * $item['quantity'];

            $orderTotal += $productTotal;

            Order::create([

                'product_id' => $productId,

                'user_id' => Auth::id(),

                'quantity' => $item['quantity'],

                'price_per_item' => $item['price'],

                'total_price' => $productTotal,

                'status' => 'pending',

            ]);

        }

        // Clear the cart after confirming the order

        session()->forget('cart');

        $this->cart = [];

        $this->total = 0;

        session()->flash('message', "Order placed successfully! Your total is $orderTotal. We will notify you once it is approved.");

    }

    public function calculateTotal()
    {

        $this->total = array_reduce($this->cart, function ($carry, $item) {

            return $carry + ($item['price'] * $item['quantity']);

        }, 0);

    }

    public function render()
    {

        return view('livewire.cart-component', ['cart' => $this->cart, 'total' => $this->total]);

    }
}
