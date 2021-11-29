<?php

use App\Models\Order;
use Laravel\Nova\Nova;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Delivery;
use App\Models\Discount;
use App\Mail\VerifyEmail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\PreOrderController;
use App\Http\Controllers\WishListController;
use App\Http\Controllers\BestSellerController;
use App\Http\Controllers\myPreOrderController;
use App\Http\Controllers\Nova\LoginController;
use App\Http\Controllers\BuyingRequestController;
use App\Http\Controllers\BuyingServiceController;
use App\Http\Controllers\PayPalPaymentController;
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
    Route::get('/verification-notice', function () {
        return view('email_verification');
    })->name('verification.notice');

    Route::get('/get-new-code', function () {
        auth()->user()->pins()->create([
            'code'=>random_int(111111, 999999),
        ]);

        Mail::to(auth()->user())->send(new VerifyEmail());
        alert('New Code has been sent to your email');
        return back();
    });

    Route::post('/check-code', function () {
        request()->validate([
            'code'=>'required'
        ]);
        $code = implode('', request()->code);
        $latestPin = auth()->user()->pins()->latest()->first();
        if ($latestPin->code == $code) {
            auth()->user()->email_verified_at = now();
            auth()->user()->save();
            alert("You're email has been verified, Enjoy Shopping!");
            return redirect('/');
        } else {
            alert("Wrong Pin Code");
            return back();
        }
    });
});

Route::get('/logout', [AuthenticationController::class, 'logout'])->name('logout')->middleware('auth');

Route::middleware(['auth','verified'])->group(function () {
    Route::redirect('/home', '/');

    Route::get('/chat/{user}', [ChatController::class, 'showMessage']);

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
    Route::get('my-requets', [BuyingServiceController::class, 'index'])->name('my-requests');
    Route::post('mark-as-completed/{order}', [OrderController::class, 'markAsCompleted']);
    Route::get('return-order/{order}', [OrderController::class, 'returnOrder']);
    Route::post('return-order/{order}', [OrderController::class, 'postReturnOrder']);
    Route::view('out-of-stack', 'pre-orders');

    //pre-orders
    Route::get('/my-pre-orders', [myPreOrderController::class, 'list']);

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

    //buying request
    Route::get('/buying-request', [BuyingServiceController::class, 'showForm']);
    Route::get('/buying-request-checkout/{buyingRequest}', [BuyingServiceController::class, 'payRequest']);
    Route::post('/buying-request', [BuyingServiceController::class, 'submitForm']);
    Route::get('/buying-receipt/{buyingRequest}', [BuyingServiceController::class, 'showReceipt']);

    //discount
    Route::get('/discount/{discount}', function (Discount $discount) {
        $productDiscounts = $discount->products;
        return view('discount_page', compact('discount', 'productDiscounts'));
    });


    Route::get('/add-new-address', [AddressController::class, 'create']);
    Route::post('/add-new-address', [AddressController::class, 'store']);
    Route::post('/set-default-address/{address}', [AddressController::class, 'setDefault']);

    Route::delete('/delete-address/{address}', [AddressController::class, 'destroy']);
    Route::view('/terms', 'terms');
    Route::view('/data', 'data');
});

//search
Route::get('/search', [SearchController::class, 'search'])->name('search');
Route::get('search-category', [SearchController::class, 'getCategory'])->name('search.category');
Route::get('/best-seller', [BestSellerController::class, 'bestSeller'])->name('best.seller');
Route::get('/pre-order', function () {
    $products = Product::where('is_pre_order', true)->get();
    return view('pre-orders', compact('products'));
});

Route::get('/page', function () {
    $data = request()->validate([
        'page'=>'required'
    ]);

    $page = $data['page'];

    return view('show_page', compact('page'));
});

Route::get('/paypal', function () {
    return view('paypal');
});

Route::get('/extract', function () {
    request()->validate([
        'ids'=>'required'
    ]);
    $orders = null;
    $ids = request()->ids;
    if ($ids == 'all') {
        $orders = Order::where('status', Order::STATUS_COMPLETED)->get();
    } else {
        $ids = explode(',', $ids);
        $orders = Order::where('status', Order::STATUS_COMPLETED)->whereIn('id', $ids)->get();
    }

    return view('sales_report', compact('orders'));
});



Route::get('email/new-invoice/{invoice}', function (Request $request, Invoice $invoice) {
    return view('mail.new-invoice', compact('invoice'));
})->name('invoice.print');


Route::get('/track-page', function () {
    $order = Delivery::where('tracking_number', request()->tracking_number??'')->first();
    return view('tracking-page', compact('order'));
});

Route::get('/demo-check', function () {
    return '6';
});
