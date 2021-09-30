<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\PayPalPaymentController;
use App\Http\Controllers\WishListController;

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

Route::get('/', [WelcomeController::class, 'index']);

Route::middleware(['guest'])->group(function () {
    Route::get('/register', [AuthenticationController::class, 'register'])->name('register');
    Route::get('/login', [AuthenticationController::class, 'login'])->name('login');

    Route::post('/register', [AuthenticationController::class, 'postRegister']);
    Route::post('/login', [AuthenticationController::class, 'postLogin']);

    Route::get('/forgot-password', [AuthenticationController::class, 'forgotPassword'])->name('forgot.password');
    Route::post('/forgot-password', [AuthenticationController::class, 'sendPasswordResetLink']);
    Route::get('/password-reset', [AuthenticationController::class, 'passwordReset'])->name('password.reset');
    Route::post('/password-reset', [AuthenticationController::class, 'postPasswordReset']);
});

Route::prefix('products')->middleware(['auth'])->name('products.')->group(function () {
    Route::get('/{product}', [ProductController::class, 'show'])->name('show');
});

Route::middleware('auth')->group(function () {
    Route::redirect('/home', '/');
    Route::get('/logout', [AuthenticationController::class, 'logout'])->name('logout');

    Route::post('/add-to-cart/{product}', [CartController::class, 'addToCart']);
    Route::post('/increase-quantity/{cart}', [CartController::class, 'increaseQuantity']);
    Route::post('/decrease-quantity/{cart}', [CartController::class, 'decreaseQuantity']);
    Route::delete('/remove-to-cart/{cart}', [CartController::class, 'removeToCart']);

    Route::get('/my-cart', [CartController::class, 'myCart']);


    //wishlist
    Route::post('add-to-wishlist/{product}', [WishListController::class, 'addToWishList'])->name('add.wishlist');
    Route::get('/my-wishlist', [WishListController::class, 'myWishList'])->name('my.wishlist');
});

Route::get('/paypal', function () {
    return view('paypal');
});
