<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GoogleController;

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
route::get('/adminDashboard', [HomeController::class, 'adminDashboard'])->middleware(['auth', 'admin']);

route::get('auth/google', [GoogleController::class, 'googlePage'])->name('auth.google');
route::get('auth/google/callback', [GoogleController::class, 'googleCallBack']);


