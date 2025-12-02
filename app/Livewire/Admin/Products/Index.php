<?php

namespace App\Livewire\Admin\Products;

use App\Livewire\Forms\ProductForm;
use App\Models\Category;
use App\Models\Product;
use App\Services\ProductService;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Index extends Component
{
    use WithFileUploads;
    use WithPagination;

    public ProductForm $form;

    // Filter properties
    public $search = '';
    public $selectedCategories = [];
    public $priceFrom;
    public $priceTo;
    public $perPage = 5;

    // Mass action properties
    public $selectedProducts = [];
    public $selectAll = false;

    // View properties
    public ?Product $viewingProduct = null;

    // State
    public $is_edit = false;
    public $confirmingDeletion = false;
    public $deletingId = null;

    // Listeners
    protected $listeners = ['deleteConfirmed' => 'deleteProduct'];

    public function mount()
    {
        // No need to load categories here as we'll load them in render for the filter
    }

    // --- Filter & Pagination Methods ---

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

    public function resetFilters()
    {
        $this->search = '';
        $this->selectedCategories = [];
        $this->priceFrom = null;
        $this->priceTo = null;
        $this->resetPage();
    }

    public $confirmingProductDeletion = false;
    public $confirmingMultipleProductDeletion = false;
    public $isCreateModalOpen = false;
    public $isEditModalOpen = false;
    public $isPreviewModalOpen = false;

    public function create()
    {
        $this->form->reset();
        $this->isCreateModalOpen = true;
    }

    public function saveProduct()
    {
        $this->form->store();
        session()->flash('message', 'Product added successfully!');
        $this->isCreateModalOpen = false;
    }

    public function edit(Product $product)
    {
        $this->form->setProduct($product);
        $this->isEditModalOpen = true;
    }

    public function updateProduct()
    {
        $this->form->update();
        session()->flash('message', 'Product updated successfully!');
        $this->isEditModalOpen = false;
    }

    public function deleteId($id)
    {
        $this->deletingId = $id;
        $this->confirmingProductDeletion = true;
    }

    public function deleteProduct(ProductService $productService)
    {
        $product = Product::find($this->deletingId);
        if ($product) {
            $productService->deleteProduct($product);
            session()->flash('message', 'Product deleted successfully!');
        }
        $this->confirmingProductDeletion = false;
        $this->deletingId = null;
    }

    public function deleteSelected()
    {
        $this->confirmingMultipleProductDeletion = true;
    }

    public function confirmDeleteSelected(ProductService $productService)
    {
        $productService->deleteProducts($this->selectedProducts);

        $this->selectedProducts = [];
        $this->selectAll = false;
        session()->flash('message', 'Selected products deleted successfully!');
        $this->confirmingMultipleProductDeletion = false;
    }

    public function show(Product $product)
    {
        $this->viewingProduct = $product;
        $this->isPreviewModalOpen = true;
    }

    public function togglePopular(Product $product, ProductService $productService)
    {
        $productService->togglePopularity($product);
        session()->flash('message', 'Product popularity updated!');
    }

    public function updatedSelectAll($value, ProductService $productService)
    {
        if ($value) {
            $this->selectedProducts = $productService->getFilteredProductsQuery(
                $this->search,
                $this->selectedCategories,
                $this->priceFrom,
                $this->priceTo
            )->pluck('id')->map(fn($id) => (string) $id)->toArray();
        } else {
            $this->selectedProducts = [];
        }
    }

    public function render(ProductService $productService)
    {
        $products = $productService->getFilteredProductsQuery(
            $this->search,
            $this->selectedCategories,
            $this->priceFrom,
            $this->priceTo
        )->paginate($this->perPage);

        $categories = Category::all();

        return view('livewire.admin.products.index', [
            'products' => $products,
            'categories' => $categories,
        ])->layout('components.layouts.admin', [
                    'title' => 'Manage Products',
                    'icon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" /></svg>',
                    'header_color' => 'text-teal-600'
                ]);
    }
}
