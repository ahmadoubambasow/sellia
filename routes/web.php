<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified', 'shop'])->group(function () {

    Route::view('/dashboard', 'dashboard')
        ->name('dashboard');

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::get('/shop/setup', [ShopController::class, 'create'])
        ->name('shop.setup');

    Route::post('/shop/setup', [ShopController::class, 'store'])
        ->name('shop.store');

});

require __DIR__.'/auth.php';
