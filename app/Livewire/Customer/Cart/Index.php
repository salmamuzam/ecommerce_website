<?php

namespace App\Livewire\Customer\Cart;

use App\Services\CartService;
use Livewire\Component;

class Index extends Component
{
    public $cart = [];

    public $total = 0;

    public function mount(CartService $cartService)
    {
        $this->cart = session()->get('cart', []);

        // Sync missing details using service
        $cartService->syncCartDetails();

        // Refresh cart from session after sync
        $this->cart = session()->get('cart', []);

        $this->total = $cartService->calculateTotal();
    }

    public function removeFromCart($productId, CartService $cartService)
    {
        $cartService->removeFromCart($productId);

        $this->cart = session()->get('cart', []);
        $this->total = $cartService->calculateTotal();

        $this->dispatch('cart-alert', type: 'success', message: 'Product removed from cart.');
    }


    public function updateQuantity($productId, $quantity, CartService $cartService)
    {
        $cartService->updateQuantity($productId, $quantity);

        $this->cart = session()->get('cart', []);
        $this->total = $cartService->calculateTotal();

        $this->dispatch('cart-alert', type: 'success', message: 'Cart updated successfully.');
    }

    public function confirmOrder(CartService $cartService)
    {
        $result = $cartService->createOrder();

        if ($result['status'] === 'error') {
            session()->flash('error', $result['message']);
            return;
        }

        $this->cart = [];
        $this->total = 0;

        session()->flash('message', $result['message']);
    }

    public function render()
    {
        return view('livewire.customer.cart.index', ['cart' => $this->cart, 'total' => $this->total]);
    }
}
