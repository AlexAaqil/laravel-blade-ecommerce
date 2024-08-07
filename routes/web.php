<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GeneralPagesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserMessageController;
use App\Http\Controllers\BlogCategoryController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Product\ProductMeasurementController;
use App\Http\Controllers\Product\ProductCategoryController;
use App\Http\Controllers\Product\ProductImageController;
use App\Http\Controllers\Product\ProductReviewController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\SaleController;

Route::get('/', [GeneralPagesController::class, 'home'])->name('home');
Route::view('/about', 'about')->name('about');

Route::get('/shop', [GeneralPagesController::class, 'shop'])->name('shop');
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('products.show');
Route::get('/products/search', [ProductController::class, 'products_search'])->name('products.search');
Route::get('/products/{category}', [ProductController::class, 'products_categorized'])->name('products.categorized');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{product}', [CartController::class, 'store'])->name('cart.store');
Route::post('/cart/quantity/{product}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/destory/{product}', [CartController::class, 'destroy'])->name('cart.destroy');

Route::view('/contact', 'contact')->name('contact');
Route::post('/contact', [UserMessageController::class, 'store'])->name('user-messages.store');

Route::get('/blogs', [BlogController::class, 'users_blogs'])->name('users.blogs');
Route::get('/blogs/{slug}', [BlogController::class, 'show'])->name('blogs.show');

require __DIR__.'/auth.php';

Route::middleware(['auth', 'verified', 'active'])->group(function () {
    Route::get('/home', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/product-reviews/{product}', [ProductReviewController::class, 'create'])->name('product-reviews.create');
    Route::post('/product-reviews/{product}', [ProductReviewController::class, 'store'])->name('product-reviews.store');

    Route::get('/checkout', [SaleController::class, 'create'])->name('checkout.create');
    Route::post('/checkout', [SaleController::class, 'store'])->name('checkout.store');
});

Route::middleware(['auth', 'verified', 'active', 'admin'])
->prefix('admin')
->group(function() {
    Route::get('/dashboard', [DashboardController::class, 'admin_dashboard'])->name('admin.dashboard');

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::patch('/users/{user}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    Route::resource('user-messages', UserMessageController::class)->only('index', 'show', 'destroy');

    Route::resource('product-reviews', ProductReviewController::class)->except('create', 'store');
    Route::resource('product-categories', ProductCategoryController::class);
    Route::resource('product-measurements', ProductMeasurementController::class);
    Route::resource('products', ProductController::class)->except('show');
    Route::get('/products-images/delete/{id}', [ProductImageController::class, 'destroy'])->name('product-images.destroy');
    Route::post('/product-images/sort', [ProductImageController::class, 'sort'])->name('product-images.sort');

    Route::resource('blog-categories', BlogCategoryController::class)->only('store', 'edit', 'update', 'destroy');
    Route::resource('blogs', BlogController::class)->except('show');
    Route::post('/blogs/sort-lessons', [BlogController::class, 'sort_blogs'])->name('blogs.sort');
});
