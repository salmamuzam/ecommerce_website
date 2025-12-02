<?php

use App\Http\Controllers\HomeController;
use App\Livewire\Admin\Categories\Index as AdminCategories;
use App\Livewire\Admin\Orders\Index as AdminOrders;
use App\Livewire\Admin\Products\Index as AdminProducts;
use App\Livewire\AdminDashboard;
use Illuminate\Support\Facades\Route;

// Admin routes: Accessible only by authenticated users with 'admin' role
Route::middleware(['auth', 'admin'])->group(function () {

    // Admin Dashboard
    Route::get('/admin/dashboard', AdminDashboard::class)->name('admin.dashboard');

    // Category Management
    Route::get('/admin/categories', AdminCategories::class)->name('admin.categories');

    // Product Management
    Route::get('/admin/products', AdminProducts::class)->name('admin.products');

    // Order Management
    Route::get('/admin/orders', AdminOrders::class)->name('admin.orders');
});
