<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use Livewire\Attributes\Validate;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductForm extends Form
{
    public ?Product $product = null;

    #[Validate('required|min:3')]
    public $title = '';

    #[Validate('required|min:10')]
    public $description = '';

    #[Validate('required|numeric|min:0')]
    public $price = '';

    #[Validate('required|exists:categories,id')]
    public $category_id = '';

    #[Validate('boolean')]
    public $is_popular = false;

    public $image;
    public $new_image;
    public $old_image;

    public function setProduct(Product $product)
    {
        $this->product = $product;
        $this->title = $product->title;
        $this->description = $product->description;
        $this->price = $product->price;
        $this->category_id = $product->category_id;
        $this->is_popular = $product->is_popular;
        $this->old_image = $product->image;
        $this->new_image = null;
        $this->image = null;
    }

    public function store()
    {
        $this->validate([
            'image' => 'required|image|max:1024',
        ]);

        $path = $this->image->store('products', 'public');

        Product::create([
            'title' => $this->title,
            'description' => $this->description,
            'price' => $this->price,
            'category_id' => $this->category_id,
            'is_popular' => $this->is_popular,
            'image' => $path,
        ]);

        $this->reset();
    }

    public function update()
    {
        $this->validate([
            'new_image' => 'nullable|image|max:1024',
        ]);

        $data = [
            'title' => $this->title,
            'description' => $this->description,
            'price' => $this->price,
            'category_id' => $this->category_id,
            'is_popular' => $this->is_popular,
        ];

        if ($this->new_image) {
            if ($this->product->image) {
                Storage::disk('public')->delete($this->product->image);
            }
            $data['image'] = $this->new_image->store('products', 'public');
        }

        $this->product->update($data);
        $this->reset();
    }
}
