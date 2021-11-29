<?php

namespace App\Providers;

use App\Models\BuyingRequest;
use App\Models\Order;
use App\Models\Invoice;
use App\Models\Message;
use App\Models\Product;
use App\Observers\BuyingRequestObserver;
use App\Observers\OrderObserver;
use App\Observers\InvoiceObserver;
use App\Observers\MessageObserver;
use App\Observers\ProductObserver;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Product::observe(ProductObserver::class);
        Invoice::observe(InvoiceObserver::class);
        Order::observe(OrderObserver::class);
        Message::observe(MessageObserver::class);
    }
}
