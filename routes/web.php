<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\StockMovementController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthenticatedSessionController::class, 'create']);
Route::get('/register', [RegisteredUserController::class, 'create']);


Route::middleware(['auth', 'verified', 'shop'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::resource('categories', CategoryController::class)
        ->except(['show']);

    Route::resource('products', ProductController::class)
        ->except(['show']);

    Route::resource('stock-movements', StockMovementController::class)
    ->only([
        'index',
        'create',
        'store',
    ])
        ->names('stock-movements');
    
    Route::resource('customers', CustomerController::class)
        ->except(['show']);

    Route::resource('sales', SaleController::class)
        ->only(['index', 'create', 'store', 'show'])
        ->names('sales');
    
    Route::post('/sales/{sale}/cancel',[SaleController::class, 'cancel'])
        ->name('sales.cancel');


    Route::get('/sales/{sale}/payments/create',[PaymentController::class, 'create'])
        ->name('sales.payments.create');

    Route::post('/sales/{sale}/payments',[PaymentController::class, 'store'])
        ->name('sales.payments.store');

    Route::get('/sales/{sale}/receipt', [SaleController::class, 'receipt'])
        ->name('sales.receipt');

    Route::get('/search', [SearchController::class, 'index'])
        ->name('search');
    
    Route::get('/search/suggestions', [SearchController::class, 'suggestions'])
        ->name('search.suggestions');

    Route::get('/notifications', [NotificationController::class, 'index'])
        ->name('notifications.index');

    Route::patch('/notifications/{notification}/read', [NotificationController::class, 'markAsRead'])
        ->name('notifications.read');

    Route::patch('/notifications/read-all', [NotificationController::class, 'markAllAsRead'])
        ->name('notifications.read-all');
        
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
