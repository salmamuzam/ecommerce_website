<?php

namespace App\Livewire\Customer\Shop;

use App\Models\Category;
use App\Models\Product;
use App\Services\CartService;
use App\Services\ProductService;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    // Filter properties
    public $selectedCategories = [];
    public $min_price = 0;
    public $max_price = 1000; // Default fallback
    public $db_max_price;
    public $orderBy = 'Default Sorting';
    public $pageSize = 12;

    // Initialize component state
    public function mount()
    {
        // Set max price based on highest product price in DB
        $this->db_max_price = ceil(Product::max('price') / 1000) * 1000;
        $this->max_price = $this->db_max_price;
    }

    // Reset all filters to default
    public function resetFilters()
    {
        $this->selectedCategories = [];
        $this->min_price = 0;
        $this->max_price = $this->db_max_price;
        $this->orderBy = 'Default Sorting';
        $this->resetPage();
    }

    // Load more products (pagination)
    public function loadMore()
    {
        $this->pageSize += 12;
    }

    // Add a product to the cart
    public function addToCart($productId, CartService $cartService)
    {
        $result = $cartService->addToCart($productId);

        if ($result['status'] === 'error') {
            session()->flash('error', $result['message']);
            return;
        }

        $this->dispatch('show-success-modal');
        session()->flash('message', $result['message']);
    }

    // Render the shop view with filtered products
    public function render(ProductService $productService)
    {
        $categories = Category::all();

        $products = $productService->getFilteredProductsQuery(
            '', // No search term in shop component currently
            (array) $this->selectedCategories,
            $this->min_price,
            $this->max_price,
            $this->orderBy
        )->paginate($this->pageSize);

        return view('livewire.customer.shop.index', [
            'products' => $products,
            'categories' => $categories,
        ]);
    }
}
