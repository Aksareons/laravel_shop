<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [PageController::class, 'index'])->name('index');

Route::resource('catalog', CatalogController::class)->parameters([
    'catalog' => 'slug'
]);

Route::prefix('cart')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('cart.index');
    Route::get('add/{productId}', [CartController::class, 'add'])->name('cart.add');
    Route::patch('update', [CartController::class, 'update'])->name('cart.update');
    Route::get('drop', [CartController::class, 'drop'])->name('cart.drop');
    Route::get('destroy', [CartController::class, 'destroy'])->name('cart.destroy');
    Route::get('checkout', [CartController::class, 'checkout'])->name('cart.checkout');
    Route::get('success/{orderId}', [CartController::class, 'success'])->name('cart.success');
});

Route::resource('order', OrderController::class);

// Admin Panel
Route::group(['prefix' => 'admin-panel', 'middleware' => ['auth', 'admin-panel']], function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');

    // Users
    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('admin.users.index');
        Route::get('edit/{user}', [UserController::class, 'edit'])->name('admin.users.edit');
        Route::put('edit/{user}', [UserController::class, 'update'])->name('admin.users.update');
        Route::get('delete/{user}', [UserController::class, 'delete'])->name('admin.users.delete');
    });

    // Products
    Route::prefix('products')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('admin.products.index');
        Route::get('create', [ProductController::class, 'create'])->name('admin.products.create');
        Route::post('create', [ProductController::class, 'store'])->name('admin.products.store');
        Route::get('edit/{product}', [ProductController::class, 'edit'])->name('admin.products.edit');
        Route::put('edit/{product}', [ProductController::class, 'update'])->name('admin.products.update');
        Route::get('delete/{product}', [ProductController::class, 'delete'])->name('admin.products.delete');
        Route::get('drop/{id}', [ProductController::class, 'destroy'])->name('admin.products.destroy');
        Route::get('restore/{id}', [ProductController::class, 'restore'])->name('admin.products.restore');
    });

    // Orders
    Route::prefix('orders')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('admin.orders.index');
        Route::get('show/{order}', [OrderController::class, 'show'])->name('admin.orders.show');
        Route::get('delete/{id}', [OrderController::class, 'delete'])->name('admin.orders.delete');

      
        
    });

      //Galleries
      Route::prefix('galleries')->group(function () {
        Route::resource('gallery', GalleryController::class);
        Route::get('delete/{id}', [GalleryController::class, 'delete'])->name('gallery.delete');

    
    });
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
