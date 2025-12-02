<?php

use App\Http\Controllers\HomeController;
use App\Livewire\Admin\Categories\Index as AdminCategories;
use App\Livewire\Admin\Orders\Index as AdminOrders;
use App\Livewire\Admin\Products\Index as AdminProducts;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/adminDashboard', [HomeController::class, 'adminDashboard']);

    Route::get('/admin/categories', AdminCategories::class)->name('admin.categories');

    Route::get('/admin/products', AdminProducts::class)->name('admin.products');

    Route::get('/admin/orders', AdminOrders::class)->name('admin.orders');
});
