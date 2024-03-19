<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Products\ProductsController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

// Products All Routes
Route::get('/products/product-single/{id}', [ProductsController::class, 'singleProduct'])->name('product.single');

Route::post('/products/product-single/{id}', [ProductsController::class, 'addCart'])->name('add.Cart');

Route::get('/products/cart', [ProductsController::class, 'showCart'])->name('cart');

Route::get('/products/cart-delete/{id}', [ProductsController::class, 'deleteProductCart'])->name('delete.product.cart');


//Checkout Routes

Route::post('/products/prepare-checkout', [ProductsController::class, 'prepareCheckout'])->name('prepare.checkout');

Route::get('/products/checkout', [ProductsController::class, 'Checkout'])->name('checkout');

Route::post('/products/store-checkout', [ProductsController::class, 'storeCheckout'])->name('process.checkout');

// Route::post('/products/process-checkout', [ProductsController::class, 'processCheckout'])->name('process.checkout');

