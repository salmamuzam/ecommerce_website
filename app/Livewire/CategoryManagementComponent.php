<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;


use Livewire\WithFileUploads;

class CategoryManagementComponent extends Component
{
    use WithFileUploads;

    // Define variables
    public $name;
    public $image;
    // public $categories; // Removed for dynamic fetching
    public $edit_id;
    public $delete_id;
    public $view_category;
    public $new_image; // For handling new image upload during edit
    public $old_image; // For storing existing image path during edit
    public $search = '';

    public function mount()
    {
        // No need to fetch categories here
    }

    public function create()
    {
        $this->resetInput();
        $this->addError('name', 'Name is required');
        $this->addError('image', 'Image is required');
        $this->dispatch('open-create-modal');
    }

    protected function rules()
    {
        return [
            'name' => 'required|regex:/^[a-zA-Z\s]+$/|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:1024',
            'new_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:1024',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    // Function to send category to the database

    public function saveCategory()
    {
        // Validate inputs
        $this->validate([
            'name' => $this->rules()['name'],
            'image' => $this->rules()['image'],
        ]);

        // Store image
        $imagePath = $this->uploadImage($this->image);

        // Create the category in the database
        Category::create([
            'name' => $this->name,
            'image' => $imagePath
        ]);

        // Empty the input fields once the category is added
        $this->resetInput();

        // Flash message
        session()->flash('message', 'Category added successfully!');

        // Close modal (handled by frontend JS usually, or we can dispatch event)
        $this->dispatch('close-modal');
    }

    public function edit($id)
    {
        $this->resetValidation();
        $category = Category::find($id);
        $this->edit_id = $id;
        $this->name = $category->name;
        $this->old_image = $category->image; // Keep existing image path
        $this->new_image = null; // Reset new image

        $this->dispatch('open-edit-modal');
    }

    public function updateCategory()
    {
        $this->validate([
            'name' => $this->rules()['name'],
            'new_image' => $this->rules()['new_image'],
        ]);

        $category = Category::find($this->edit_id);

        $data = [
            'name' => $this->name,
        ];

        if ($this->new_image) {
            $data['image'] = $this->uploadImage($this->new_image);
        }

        $category->update($data);

        $this->resetInput();
        session()->flash('message', 'Category updated successfully!');
        $this->dispatch('close-modal');
    }

    public function messages()
    {
        return [
            'name.regex' => 'Invalid name..please enter only text',
            'name.required' => 'Name is required',
            'image.required' => 'Image is required',
            'image.mimes' => 'Invalid file format.pls upload only images',
            'new_image.mimes' => 'Invalid file format.pls upload only images',
        ];
    }

    public function deleteId($id)
    {
        $this->delete_id = $id;
        $this->dispatch('open-delete-modal');
    }

    public function deleteCategory()
    {
        $category = Category::find($this->delete_id);
        if ($category) {
            $category->delete();
            session()->flash('message', 'Category deleted successfully!');
        }
        $this->dispatch('close-modal');
    }

    public function show($id)
    {
        $this->view_category = Category::find($id);
        $this->dispatch('open-preview-modal');
    }

    public function resetInput()
    {
        $this->name = '';
        $this->image = null;
        $this->new_image = null;
        $this->old_image = null;
        $this->edit_id = null;
        $this->delete_id = null;
        $this->view_category = null;
    }

    private function uploadImage($file)
    {
        return $file->store('categories', 'public');
    }

    public function render()
    {
        $categories = Category::search($this->search)->get();

        return view('livewire.category-management-component', [
            // Return all categories
            'categories' => $categories,
        ])->layout('components.layouts.admin', [
                    'title' => 'Manage Categories',
                    'icon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6"><path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z" /></svg>',
                    'header_color' => 'text-teal-600'
                ]);
    }
}
