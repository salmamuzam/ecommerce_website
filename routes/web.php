<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GoogleController;
use App\Livewire\CategoryManagementComponent;
use App\Livewire\OrderManagementComponent;
use App\Livewire\ProductManagementComponent;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// When a user is logged, redirect to /home
route::get('/home', [HomeController::class, 'index']);

// When the /adminDashboard route is accessed, it will check whether the user is logged in as well
// If the user is not logged, it will direct the user to the login page

// Route route based on middleware
// Must be verified, and must be an admin to access the following routes
route::middleware(['auth', 'admin'])->group(function () {

    route::get('/adminDashboard', [HomeController::class, 'adminDashboard']);

    Route::get('/admin/categories', CategoryManagementComponent::class)->name('admin.categories');

    Route::get('/admin/products', ProductManagementComponent::class)->name('admin.products');

    Route::get('/admin/orders', OrderManagementComponent::class)->name('admin.orders');
});


route::get('auth/google', [GoogleController::class, 'googlePage'])->name('auth.google');
route::get('auth/google/callback', [GoogleController::class, 'googleCallBack']);


