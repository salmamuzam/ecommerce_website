<?php

namespace App\Livewire\Customer\Products;

use App\Models\Product;
use Livewire\Component;

class Show extends Component
{
    public $product;

    /**

     * Mount the component with the selected product.

     */

    public function mount($id)
    {
        // id is cast from route

        $this->product = Product::findOrFail($id);
    }

    // Add the current product to the cart
    public function addToCart($productId)
    {
        // Find product
        $product = Product::find($productId);

        if (!$product) {

            session()->flash('error', 'Product not found.');

            return;

        }

        // Retrieve existing cart from session or create a new one

        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {

            $cart[$productId]['quantity']++;

        } else {

            $cart[$productId] = [

                'title' => $product->title,

                'price' => $product->price,

                'quantity' => 1,

            ];

        }

        // Save updated cart to session

        session()->put('cart', $cart);

        $this->dispatch('show-success-modal');
    }

    // Render the product detail view
    public function render()
    {
        return view('livewire.customer.products.show');

    }
}
