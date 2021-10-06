<?php

use App\Http\Controllers\ApiAuthenticationController;
use App\Http\Controllers\ApiProductController;
use App\Models\Cart;
use Illuminate\Http\Request;
use App\Supports\OrderSupport;
use App\Supports\InvoiceSupport;
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
});

Route::post('/payment-success', function () {
    $userId = request()->uid;
    $invoice = InvoiceSupport::createInvoice(request(), $userId);
    if ($invoice != null) {
        $carts = Cart::where('user_id', $userId)->get();
        OrderSupport::createOrder($invoice->id, $userId, $carts);
    }
    return redirect(route('payment.success'));
});


//authentication
Route::post('/login', [ApiAuthenticationController::class, 'login']);
Route::post('/register', [ApiAuthenticationController::class, 'register']);


Route::post('/payment-cancelled', function () {
    return 'you cancelled your payment';
});

Route::post('/paypal-callback', function () {
    Log::info('callback called!');
});


//mobile app api
Route::get('/products', [ApiProductController::class, 'index']);
