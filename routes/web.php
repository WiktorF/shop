<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
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
        Route::get('/users/list',  [UsersController::class, 'index'])->middleware('can:isAdmin');
        Route::delete('/users/{user}',  [UsersController::class, 'destroy'])->middleware('can:isAdmin');
    });
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::post('/cart/{product}', [App\Http\Controllers\CartController::class, 'store'])->name('cart.store');
    Route::get('/cart/list', [App\Http\Controllers\CartController::class, 'index'])->name('cart.index');
});

Auth::routes(['verify' => true]);
