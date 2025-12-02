<?php

use App\Livewire\Customer\Cart\Index as Cart;
use Illuminate\Support\Facades\Route;

// Customer routes: Accessible only by authenticated users with 'customer' role
Route::middleware(['auth', 'customer'])->group(function () {
    // Shopping Cart
    Route::get('/cart', Cart::class)->name('cart');
});
