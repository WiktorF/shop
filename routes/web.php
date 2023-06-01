<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\Hellov2Controller;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WelcomeController;

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
    return view('welcome');
});

Route::get('/hello',  [Hellov2Controller::class, 'show']);

Route::get('/',  [WelcomeController::class, 'index']);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::middleware(['can:isAdmin'])->group(function () {
        Route::get('/products/{product}/download',  [ProductController::class, 'downloadImage'])->name('products.downloadImage');
        Route::resource('products',  ProductController::class)->middleware('can:isAdmin');

        Route::resource('users', UsersController::class)->only([
            'destroy', 'edit', 'update', 'index'
        ]);
    });
    Route::delete('/cart/{product}',  [CartController::class, 'destroy'])->name('cart.destroy');
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::post('/cart/{product}', [CartController::class, 'store'])->name('cart.store');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
});

Auth::routes(['verify' => true]);
