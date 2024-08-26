<?php

use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductImageController;
use App\Http\Controllers\Admin\TagController;
use Illuminate\Support\Facades\Route;

/* Admin Panel Routes */

Route::get('admin-panel/dashboard', function () {
    return view('admin.dashboard');
})->name('dashboard');

/*
 * name('admin.') => used for prefix route
 *
 */
Route::prefix('admin-panel/management')->name('admin.')->group(function () {

    Route::resource('brands', BrandController::class);
    Route::resource('attributes', AttributeController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('tags', TagController::class);
    Route::resource('products', ProductController::class);
    Route::resource('banners', BannerController::class);

    // get category attributes
    Route::get('/category-attributes/{category}', [CategoryController::class, 'showAttributes']);

    // product images
    Route::get('/products/{product}/edit-images', [ProductImageController::class, 'editImages'])->name('products.images.edit');
    Route::delete('/products/{product}/images-destroy', [ProductImageController::class, 'destroy'])->name('products.images.destroy');
    Route::put('/products/{product}/images-set-primary', [ProductImageController::class, 'setPrimary'])->name('products.images.set_primary');
    Route::post('/products/{product}/images-store', [ProductImageController::class, 'store'])->name('products.images.store');

    // edit category
    Route::get('/products/{product}/category-edit', [ProductController::class, 'categoryEdit'])->name('products.category.edit');
    Route::put('/products/{product}/category-update', [ProductController::class, 'categoryUpdate'])->name('products.category.update');

});
