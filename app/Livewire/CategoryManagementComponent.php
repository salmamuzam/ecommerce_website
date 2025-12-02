<?php

namespace App\Livewire;

use App\Livewire\Forms\CategoryForm;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class CategoryManagementComponent extends Component
{
    use WithFileUploads;

    public CategoryForm $form;

    // State
    public $search = '';
    public $delete_id;
    public ?Category $viewingCategory = null;

    public $isCreateModalOpen = false;
    public $isEditModalOpen = false;
    public $confirmingCategoryDeletion = false;
    public $isPreviewModalOpen = false;

    public function mount()
    {
        // No need to fetch categories here
    }

    public function create()
    {
        $this->form->reset();
        $this->isCreateModalOpen = true;
    }

    public function saveCategory()
    {
        $this->form->store();
        session()->flash('message', 'Category added successfully!');
        $this->isCreateModalOpen = false;
    }

    public function edit(Category $category)
    {
        $this->form->setCategory($category);
        $this->isEditModalOpen = true;
    }

    public function updateCategory()
    {
        $this->form->update();
        session()->flash('message', 'Category updated successfully!');
        $this->isEditModalOpen = false;
    }

    public function deleteId($id)
    {
        $this->delete_id = $id;
        $this->confirmingCategoryDeletion = true;
    }

    public function deleteCategory()
    {
        $category = Category::find($this->delete_id);
        if ($category) {
            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }
            $category->delete();
            session()->flash('message', 'Category deleted successfully!');
        }
        $this->confirmingCategoryDeletion = false;
        $this->delete_id = null;
    }

    public function show(Category $category)
    {
        $this->viewingCategory = $category;
        $this->isPreviewModalOpen = true;
    }

    public function render()
    {
        $categories = Category::search($this->search)->get();

        return view('livewire.category-management-component', [
            'categories' => $categories,
        ])->layout('components.layouts.admin', [
                    'title' => 'Manage Categories',
                    'icon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6"><path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z" /></svg>',
                    'header_color' => 'text-teal-600'
                ]);
    }
}
