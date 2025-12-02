<?php

use App\Livewire\Customer\Cart\Index as Cart;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'customer'])->group(function () {
    // Only customer can view this page
    Route::get('/cart', Cart::class)->name('cart');
});
