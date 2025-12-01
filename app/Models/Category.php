<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'image'];

    // Relationship
    // One category contains many products
    // For example, "Abaya" category contains many products
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    // Scopes
    public function scopeSearch($query, $term)
    {
        $term = "%$term%";
        $query->where(function ($query) use ($term) {
            $query->where('name', 'like', $term);
        });
    }
}
