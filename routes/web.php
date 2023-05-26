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

Route::middleware(['auth', 'verified'])->group(function(){
    Route::resource('products',  ProductController::class);

    Route::get('/users/list',  [UsersController::class, 'index'])->middleware('auth');
    Route::delete('/users/{user}',  [UsersController::class, 'destroy'])->middleware('auth');

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});

Auth::routes(['verify' => true]);


