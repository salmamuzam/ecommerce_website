<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;

class ProductService
{
    /**
     * Get a query builder for products based on filters.
     *
     * @param string $search
     * @param array $selectedCategories
     * @param float|null $priceFrom
     * @param float|null $priceTo
     * @param string $orderBy
     * @return Builder
     */
    public function getFilteredProductsQuery(
        string $search = '',
        array $selectedCategories = [],
        ?float $priceFrom = null,
        ?float $priceTo = null,
        string $orderBy = 'Default Sorting'
    ): Builder {
        return Product::query()
            ->when($search, function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            })
            ->when($selectedCategories, function ($query) use ($selectedCategories) {
                $query->whereIn('category_id', $selectedCategories);
            })
            ->when($priceFrom, function ($query) use ($priceFrom) {
                $query->where('price', '>=', $priceFrom);
            })
            ->when($priceTo, function ($query) use ($priceTo) {
                $query->where('price', '<=', $priceTo);
            })
            ->when($orderBy == 'Popular', function ($query) {
                $query->where('is_popular', true);
            })
            ->when($orderBy == 'Price: Low to High', function ($query) {
                $query->orderBy('price', 'asc');
            })
            ->when($orderBy == 'Price: High to Low', function ($query) {
                $query->orderBy('price', 'desc');
            });
    }

    /**
     * Delete a product and its associated image.
     *
     * @param Product $product
     * @return void
     */
    public function deleteProduct(Product $product): void
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();
    }

    /**
     * Delete multiple products by their IDs.
     *
     * @param array $productIds
     * @return void
     */
    public function deleteProducts(array $productIds): void
    {
        $products = Product::whereIn('id', $productIds)->get();
        foreach ($products as $product) {
            $this->deleteProduct($product);
        }
    }

    /**
     * Toggle the popularity status of a product.
     *
     * @param Product $product
     * @return void
     */
    public function togglePopularity(Product $product): void
    {
        $product->is_popular = !$product->is_popular;
        $product->save();
    }
}
