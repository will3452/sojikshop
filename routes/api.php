<?php

use App\Http\Controllers\ApiAuthenticationController;
use App\Http\Controllers\ApiProductController;
use App\Models\Cart;
use App\Supports\Invoice as InvoiceSupport;
use App\Supports\Order as OrderSupport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

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
});


Route::post('/create-order', function () {
    $invoice = InvoiceSupport::createInvoice(request());

    $order = OrderSupport::createOrder(request(), $invoice->id);
    return $order;
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
