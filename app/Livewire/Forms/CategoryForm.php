<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use Livewire\Attributes\Validate;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class CategoryForm extends Form
{
    public ?Category $category = null;

    #[Validate('required|regex:/^[a-zA-Z\s]+$/|max:255')]
    public $name = '';

    public $image;
    public $new_image;
    public $old_image;

    public function setCategory(Category $category)
    {
        $this->category = $category;
        $this->name = $category->name;
        $this->old_image = $category->image;
        $this->new_image = null;
        $this->image = null;
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|regex:/^[a-zA-Z\s]+$/|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:1024',
        ]);

        $path = $this->image->store('categories', 'public');

        Category::create([
            'name' => $this->name,
            'image' => $path,
        ]);

        $this->reset();
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|regex:/^[a-zA-Z\s]+$/|max:255',
            'new_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:1024',
        ]);

        $data = [
            'name' => $this->name,
        ];

        if ($this->new_image) {
            if ($this->category->image) {
                Storage::disk('public')->delete($this->category->image);
            }
            $data['image'] = $this->new_image->store('categories', 'public');
        }

        $this->category->update($data);
        $this->reset();
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
}
