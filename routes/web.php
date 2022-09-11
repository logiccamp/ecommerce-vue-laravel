<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartsController;
use App\Http\Controllers\CheckoutsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SquareController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index'])->name('homepage');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/shop', [App\Http\Controllers\HomeController::class, 'shop']);
Route::get('/category/{title}', [App\Http\Controllers\HomeController::class, 'category']);
Route::get('/about', [App\Http\Controllers\HomeController::class, 'about']);
Route::get('/return-policy', [App\Http\Controllers\HomeController::class, 'returnP']);
Route::get('/terms-and-condition', [App\Http\Controllers\HomeController::class, 'terms']);
Route::get('/account', [App\Http\Controllers\HomeController::class, 'account']);


Route::get('/shipping-policy', [App\Http\Controllers\HomeController::class, 'shipping']);




// Cart route

Route::get('/cart', [CartsController::class, 'index'])->name('cart');
Route::get('/getCart', [CartsController::class, 'getCart'])->name('getCart');
Route::post('/cart', [CartsController::class, 'store'])->name('addCart');
Route::post('/updateCart/{id}', [CartsController::class, 'update'])->name('updateCart');
Route::get('/deleteCart/{id}', [CartsController::class, 'destroy'])->name('deleteCart');


// Product Route
Route::get('/product/{slug}', [ProductsController::class, 'show'])->name('product');
Route::post('/getProduct', [ProductsController::class, 'getProduct'])->name('productapi');

Route::get('/checkout', [CheckoutsController::class, 'index'])->name('checkout');
Route::post('/order', [OrdersController::class, 'store'])->name('completeorder');
Route::get('/orders', [OrdersController::class, 'index']);
Route::get('/getOrder', [OrdersController::class, 'getOrder']);


Route::get('/order-complete', [OrdersController::class, 'complete']);
// firstname, lastname, address1, address2, zip, state, city, mobile

// checkout



Route::get('/upload-product', [AdminController::class, 'upload']);
Route::post('/uploadthis', [AdminController::class, 'uploadthis'])->name("uploadthis");
Route::get('/square', function () {
    return view("main.square");
});


Route::post('/add-card', [SquareController::class, 'addCard'])->name('add-card');
