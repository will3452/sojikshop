<?php

use Laravel\Nova\Nova;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\WishListController;
use App\Http\Controllers\Nova\LoginController;
use App\Http\Controllers\PayPalPaymentController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\BuyingServiceController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\PreOrderController;
use App\Http\Controllers\ProfileController;

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

//override the default login
Route::post(Nova::path('/login'), [LoginController::class, 'login'])->name('admin.login');

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
    Route::get('/remove-wishlist/{wishList}', [WishListController::class, 'removeWishList'])->name('remove.wishlist');

    Route::get('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');

    //return pyment handler
    Route::get('/payment-success', function () {
        return view('payment_success');
    })->name('payment.success');

    //orders
    Route::get('my-orders', [OrderController::class, 'myOrders'])->name('my-orders');

    //invoice
    Route::get('/invoices/{invoice}', [InvoiceController::class, 'show']);

    //pre-ordering
    Route::get('/preorder-set/{product}', [PreOrderController::class, 'setPreOrder']);
    Route::get('/preorder-pay', [PreOrderController::class, 'payPreOrder']);

    //feedback here
    Route::get('/write-feedback/{order}', [FeedbackController::class, 'writeFeedback']);
    Route::post('/write-feedback/{order}', [FeedbackController::class, 'saveFeedback']);

    //profile
    Route::get('/profile', [ProfileController::class, 'myProfile']);
    Route::post('/profile', [ProfileController::class, 'saveProfile']);
});

//search
Route::get('/search', [SearchController::class, 'search'])->name('search');
Route::get('search-category', [SearchController::class, 'getCategory'])->name('search.category');

//buying request
Route::get('/buying-request', [BuyingServiceController::class, 'showForm']);
Route::post('/buying-request', [BuyingServiceController::class, 'submitForm']);

Route::get('/paypal', function () {
    return view('paypal');
});
