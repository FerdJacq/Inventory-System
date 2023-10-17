<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StocksController;
use App\Http\Controllers\OrderController;

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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['web', 'auth'])->group(function () {

    Route::post('products/add-stock', [ProductController::class,'addStock'])->name('products.addStock');

    Route::get('/order', [OrderController::class, 'showOrderForm'])->name('order.form');
    Route::post('/order/place', [OrderController::class, 'placeOrder'])->name('order.place');
    Route::view('/order/success', 'orders.success')->name('order.success');
    Route::get('/order-history', [OrderController::class, 'orderHistory'])->name('order.history');

    Route::get('/search', [SearchController::class, 'getSuggestions'])->name('search');
});

Route::resource('products', ProductController::class);
