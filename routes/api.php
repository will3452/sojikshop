<?php

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\BuyingRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use App\Supports\Order as OrderSupport;
use App\Http\Controllers\ApiCartController;
use App\Http\Controllers\ProfileController;
use App\Supports\Invoice as InvoiceSupport;
use App\Http\Controllers\ApiOrderController;
use App\Http\Controllers\ApiAddressController;
use App\Http\Controllers\ApiProductController;
use App\Http\Controllers\ApiProfileController;
use App\Http\Controllers\ApiCheckoutController;
use App\Http\Controllers\ApiFeedbackController;
use App\Http\Controllers\ApiWishlistController;
use App\Http\Controllers\ApiBestSellerController;
use App\Http\Controllers\ApiBuyingServiceController;
use App\Http\Controllers\ApiAuthenticationController;
use App\Http\Controllers\ApiInAppController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->group(function () {
    // Route::post('/login', 'Auth');
    Route::get('/products/{id}', [ApiProductController::class, 'show']);
    Route::post('/logout', [ApiAuthenticationController::class, 'logout']);

    // cart
    Route::get('/my-carts', [ApiCartController::class, 'myCart']);
    Route::post('/add-to-cart', [ApiCartController::class, 'addToCart']);
    Route::post('/remove-to-cart', [ApiCartController::class, 'removeToCart']);
    Route::post('/increase-quantity/{cart}', [ApiCartController::class, 'increaseQuantity']);
    Route::post('/decrease-quantity/{cart}', [ApiCartController::class, 'decreaseQuantity']); // params cart-id

    //wishlists
    Route::get('/wishlists', [ApiWishlistController::class, 'getWishlists']);
    Route::post('/add-to-wishlists', [ApiWishlistController::class, 'addToWishList']);
    Route::post('/remove-to-wishlists', [ApiWishlistController::class, 'removeToWishList']);

    //profile
    Route::get('/profile', [ApiProfileController::class, 'getProfile']);
    Route::post('/profile', [ApiProfileController::class, 'saveProfile']);

    //address
    Route::get('/address', [ApiAddressController::class, 'getAddress']);
    Route::post('/address', [ApiAddressController::class, 'store']);

    //checkout or invoice
    Route::get('/invoice', [ApiCheckoutController::class, 'getInvoice']);

    //orders
    Route::get('/orders', [ApiOrderController::class, 'myOrders']);
    Route::post('order-completed/{order}', [ApiOrderController::class, 'markAsCompleted']); // mark as completed
    Route::post('order-return/{order}', [ApiOrderController::class, 'postReturnOrder']); // post order return

    //feedback
    Route::post('/feedback/{order}', [ApiFeedbackController::class, 'saveFeedback']);

    //buying request
    Route::post('/buying-request', [ApiBuyingServiceController::class, 'submitForm']);

    //app notifications
    Route::get('/get-notifications', [ApiInAppController::class, 'getUnreadNotifications']);
    Route::post('/post-notification', [ApiInAppController::class, 'updateUnreadNotification']);
});

//best seller
Route::get('/best-seller', [ApiBestSellerController::class, 'bestSeller']);

Route::get('/pre-orders', function () {
    $products = Product::where('is_pre_order', true)->get();
    return response([
        'products' => $products
    ], 200);
});

Route::get('/profile-demo', [ApiProfileController::class, 'getProfileDemo']);


Route::post('/create-order', function () {
    $invoice = InvoiceSupport::createInvoice(request());

    $order = OrderSupport::createOrder(request(), $invoice->id);
    return $order;
});


Route::post('/buying-paid', function () {
    $buyingRequest = BuyingRequest::find(request()->buying_request_id);

    $buyingRequest->update([
        'status'=>BuyingRequest::STATUS_PAID,
    ]);
    return $buyingRequest;
});

//assets
Route::get('/logo', function () {
    return response([
        'logo_path'=>url('/storage/'.nova_get_setting('logo'))
    ], 200);
});


//authentication
Route::post('/login', [ApiAuthenticationController::class, 'login']);
Route::post('/register', [ApiAuthenticationController::class, 'register']);


Route::get('/payment-cancelled', function () {
    return 'you cancelled your payment';
});

Route::post('/paypal-callback', function () {
    Log::info('callback called!');
});


//mobile app api
Route::get('/products', [ApiProductController::class, 'index']);
