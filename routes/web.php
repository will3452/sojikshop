<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthenticationController;

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

Route::get('/', [LandingController::class, 'index']);

Route::middleware(['guest'])->group(function(){

    Route::get('/register', [AuthenticationController::class, 'register'])->name('register');
    Route::get('/login', [AuthenticationController::class, 'login'])->name('login');

    Route::post('/register', [AuthenticationController::class, 'postRegister']);
    Route::post('/login', [AuthenticationController::class, 'postLogin']);
});

Route::prefix('products')->middleware(['auth'])->name('products.')->group(function(){
    Route::get('/{product}', [ProductController::class, 'show'])->name('show');
});

Route::middleware('auth')->group(function(){
    Route::redirect('/home', '/');
    Route::get('/logout', [AuthenticationController::class, 'logout'])->name('logout');

    Route::post('/add-to-cart/{product}', [CartController::class, 'addToCart']);

    Route::get('/my-cart', [CartController::class, 'myCart']);
});


