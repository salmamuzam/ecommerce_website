<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ShopComponent extends Component
{
    use WithPagination;

    public $selectedCategories = [];
    public $min_price = 0;
    public $max_price = 1000; // Default fallback
    public $db_max_price;
    public $orderBy = 'Default Sorting';
    public $pageSize = 12;

    public function mount()
    {
        $this->db_max_price = ceil(Product::max('price') / 1000) * 1000;
        $this->max_price = $this->db_max_price;
    }

    public function resetFilters()
    {
        $this->selectedCategories = [];
        $this->min_price = 0;
        $this->max_price = $this->db_max_price;
        $this->orderBy = 'Default Sorting';
        $this->resetPage();
    }

    public function loadMore()
    {
        $this->pageSize += 12;
    }

    public function addToCart($productId)
    {
        $product = Product::find($productId);

        if (!$product) {
            session()->flash('error', 'Product not found.');
            return;
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

        $this->dispatch('show-success-modal');
        session()->flash('message', 'Product added to cart successfully!');
    }

    public function render()
    {
        $categories = Category::all();

        $products = Product::query()
            ->when($this->selectedCategories, function ($query) {
                $query->whereIn('category_id', (array) $this->selectedCategories);
            })
            ->whereBetween('price', [$this->min_price, $this->max_price])
            ->when($this->orderBy == 'Popular', function ($query) {
                $query->where('is_popular', true);
            })
            ->when($this->orderBy == 'Price: Low to High', function ($query) {
                $query->orderBy('price', 'asc');
            })
            ->when($this->orderBy == 'Price: High to Low', function ($query) {
                $query->orderBy('price', 'desc');
            })
            ->paginate($this->pageSize);

        return view('livewire.shop-component', [
            'products' => $products,
            'categories' => $categories,
        ]);
    }
}
