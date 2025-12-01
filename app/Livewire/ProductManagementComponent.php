<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;

class ProductManagementComponent extends Component
{
    use WithFileUploads;
    use WithPagination;

    // Form properties
    public $title, $description, $price, $image, $category_id, $is_popular;
    public $product_id; // For edit mode
    public $is_edit = false;
    public $new_image; // For edit mode upload
    public $old_image; // For edit mode display

    // Filter properties
    public $search = '';
    public $selectedCategories = [];
    public $priceFrom;
    public $priceTo;

    // Mass action properties
    public $selectedProducts = [];
    public $selectAll = false;

    // Pagination
    public $perPage = 5;

    // View properties
    public $view_product_id;
    public $view_title;
    public $view_description;
    public $view_price;
    public $view_category;
    public $view_image;
    public $view_popular;

    // Listeners
    protected $listeners = ['deleteConfirmed' => 'deleteProduct'];

    public function show($id)
    {
        $product = Product::findOrFail($id);
        $this->view_product_id = $product->id;
        $this->view_title = $product->title;
        $this->view_description = $product->description;
        $this->view_price = $product->price;
        $this->view_category = $product->category->name ?? 'Uncategorized';
        $this->view_image = $product->image;
        $this->view_popular = $product->is_popular;

        $this->dispatch('open-view-modal');
    }

    public function mount()
    {
        // No need to load categories here as we'll load them in render for the filter
    }

    // Reset pagination when search or filters change
    public function updatedSearch()
    {
        $this->resetPage();
    }
    public function updatedSelectedCategories()
    {
        $this->resetPage();
    }
    public function updatedPriceFrom()
    {
        $this->resetPage();
    }
    public function updatedPriceTo()
    {
        $this->resetPage();
    }
    public function updatedPerPage()
    {
        $this->resetPage();
    }

    // Handle "Select All" checkbox
    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedProducts = $this->getProductsQuery()->pluck('id')->map(fn($id) => (string) $id)->toArray();
        } else {
            $this->selectedProducts = [];
        }
    }

    // Handle individual checkbox selection to update "Select All" state
    public function updatedSelectedProducts()
    {
        $this->selectAll = false;
    }

    public function resetFilters()
    {
        $this->search = '';
        $this->selectedCategories = [];
        $this->priceFrom = null;
        $this->priceTo = null;
        $this->resetPage();
    }

    // CRUD Methods

    public function create()
    {
        $this->resetInputFields();
        $this->is_edit = false;
        $this->dispatch('open-create-modal');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $this->product_id = $id;
        $this->title = $product->title;
        $this->description = $product->description;
        $this->price = $product->price;
        $this->category_id = $product->category_id;
        $this->is_popular = $product->is_popular;
        $this->old_image = $product->image;
        $this->new_image = null;
        $this->is_edit = true;

        $this->dispatch('open-edit-modal');
    }

    public function saveProduct()
    {
        $this->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required',
            'image' => 'required|image|max:1024', // 1MB Max
        ]);

        $path = $this->image->store('products', 'public');

        Product::create([
            'title' => $this->title,
            'category_id' => $this->category_id,
            'description' => $this->description,
            'price' => $this->price,
            'image' => $path,
            'is_popular' => $this->is_popular ?? false,
        ]);

        session()->flash('message', 'Product added successfully!');
        $this->dispatch('close-modal');
        $this->resetInputFields();
    }

    public function updateProduct()
    {
        $this->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required',
            'new_image' => 'nullable|image|max:1024',
        ]);

        $product = Product::findOrFail($this->product_id);

        $data = [
            'title' => $this->title,
            'category_id' => $this->category_id,
            'description' => $this->description,
            'price' => $this->price,
            'is_popular' => $this->is_popular ?? false,
        ];

        if ($this->new_image) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $this->new_image->store('products', 'public');
        }

        $product->update($data);

        session()->flash('message', 'Product updated successfully!');
        $this->dispatch('close-modal');
        $this->resetInputFields();
    }

    public function deleteId($id)
    {
        $this->product_id = $id;
        $this->dispatch('open-delete-modal');
    }

    public function deleteProduct()
    {
        $product = Product::findOrFail($this->product_id);
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();
        session()->flash('message', 'Product deleted successfully!');
        $this->dispatch('close-modal');
    }

    public function deleteSelected()
    {
        $products = Product::whereIn('id', $this->selectedProducts)->get();
        foreach ($products as $product) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $product->delete();
        }
        $this->selectedProducts = [];
        $this->selectAll = false;
        session()->flash('message', 'Selected products deleted successfully!');
    }

    public function togglePopular($id)
    {
        $product = Product::findOrFail($id);
        $product->is_popular = !$product->is_popular;
        $product->save();
    }

    private function resetInputFields()
    {
        $this->title = '';
        $this->description = '';
        $this->price = '';
        $this->image = null;
        $this->new_image = null;
        $this->old_image = null;
        $this->category_id = '';
        $this->is_popular = false;
        $this->product_id = null;
    }

    private function getProductsQuery()
    {
        return Product::query()
            ->when($this->search, function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%')
                    ->orWhere('description', 'like', '%' . $this->search . '%');
            })
            ->when(!empty($this->selectedCategories), function ($query) {
                $query->whereIn('category_id', $this->selectedCategories);
            })
            ->when($this->priceFrom, function ($query) {
                $query->where('price', '>=', $this->priceFrom);
            })
            ->when($this->priceTo, function ($query) {
                $query->where('price', '<=', $this->priceTo);
            });
    }

    public function render()
    {
        $products = $this->getProductsQuery()->paginate($this->perPage);
        $categories = Category::all();

        return view('livewire.product-management-component', [
            'products' => $products,
            'categories' => $categories,
        ])->layout('components.layouts.admin', ['title' => 'Manage Products']);
    }
}
