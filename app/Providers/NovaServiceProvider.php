<?php

namespace App\Providers;

use App\Nova\User;
use App\Models\Order;
use Laravel\Nova\Nova;
use App\Models\Invoice;
use Laravel\Nova\Fields\Code;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Image;
use App\Models\PendingDelivery;
use App\Models\Product;
use Laravel\Nova\Fields\Number;
use App\Nova\Metrics\TotalSales;
use Laravel\Nova\Fields\Textarea;
use App\Nova\Metrics\NumberOfUsers;
use Mako\CustomTableCard\Table\Row;
use App\Nova\Metrics\NumberOfOrders;
use Illuminate\Support\Facades\Gate;
use Mako\CustomTableCard\Table\Cell;
use App\Nova\Metrics\NumberOfBanners;
use App\Nova\Metrics\NumberOfProducts;
use App\Nova\Metrics\Shipped;
use App\Nova\Metrics\NumberOfCategories;
use App\Nova\Metrics\Packaging;
use Mako\CustomTableCard\CustomTableCard;
use Bolechen\NovaActivitylog\NovaActivitylog;
use OptimistDigital\NovaSettings\NovaSettings;
use Coroowicaksono\ChartJsIntegration\BarChart;
use Laravel\Nova\NovaApplicationServiceProvider;
use NumaxLab\NovaCKEditor5Classic\CKEditor5Classic;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        NovaSettings::addSettingsFields([
            Image::make('Logo'),

            CKEditor5Classic::make('FAQ', 'data_privacy')
                ->options([
                    'toolbar' => [
                        'heading',
                        '|',
                        'bold',
                        'italic',
                        'link',
                        'bulletedList',
                        'numberedList',
                        'blockQuote',
                    ],
                ]),

            CKEditor5Classic::make('Terms and Conditions')
                ->options([
                    'toolbar' => [
                        'heading',
                        '|',
                        'bold',
                        'italic',
                        'link',
                        'bulletedList',
                        'numberedList',
                        'blockQuote',
                    ],
                ]),

                CKEditor5Classic::make('Contact Us')
                ->options([
                    'toolbar' => [
                        'heading',
                        '|',
                        'bold',
                        'italic',
                        'link',
                        'bulletedList',
                        'numberedList',
                        'blockQuote',
                    ],
                ]),

                CKEditor5Classic::make('About Us')
                ->options([
                    'toolbar' => [
                        'heading',
                        '|',
                        'bold',
                        'italic',
                        'link',
                        'bulletedList',
                        'numberedList',
                        'blockQuote',
                    ],
                ]),

            Code::make('Facebook scripts'),

            Text::make('Copyright'),

            Number::make('VAT')->placeholder('in %'),

            Text::make('Checkout Vat Note'),

            Text::make('Paypal Client Id'),

            Text::make('Buy Service Message'),

            Textarea::make('Delivery Mail message'),

            Textarea::make('Feedback Mail message'),

            Textarea::make('Packaging Mail message'),

            Number::make('Low Stock'),

            Number::make('Best Seller Count'),

            Number::make('Free Shipping'),

        ]);
    }

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes()
    {
        Nova::routes()
            ->withAuthenticationRoutes()
            ->withPasswordResetRoutes()
            ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewNova', function ($user) {
            return $user->email == 'superadmin@sojikshop.store';
        });
    }

    /**
     * Get the cards that should be displayed on the default Nova dashboard.
     *
     * @return array
     */
    protected function cards()
    {
        $invoiceData = Invoice::getMonthlyData();

        $categories = [];

        $data = [];

        foreach ($invoiceData as $key => $values) {
            $categories[] = $key;
            $sale = 0;
            foreach ($values as $value) {
                $sale += $value->amount;
            }
            $data[] = $sale;
        }

        $lowstacksdata = Product::where('quantity', '<=', nova_get_setting('low_stock', 10))->orderBy('quantity')->limit(10)->get();
        $lowstackdata = [];
        foreach ($lowstacksdata as $ld) {
            $lowstackdata[] = new Row(
                new Cell($ld->reference_number),
                new Cell($ld->name),
                new Cell($ld->quantity),
            );
        }
        return [
            (new BarChart())
            ->title('Sales')
            ->animations([
                'enabled' => true,
                'easing' => 'easeinout',
            ])
            ->series(array([
                'barPercentage' => 0.5,
                'label' => 'Total Sales',
                'backgroundColor' => '#B7FBE1',
                'data' => $data,
            ]))
            ->options([
                'xaxis' => [
                    'categories' => $categories,
                ],
            ])
            ->width('2/3'),
            NumberOfProducts::make()->width('1/3'),
            NumberOfOrders::make()->width('1/2'),
            TotalSales::make()->width('1/2'),
            Shipped::make()->width('1/2'),
            Packaging::make()->width('1/2'),
            (new CustomTableCard)
            ->header([
                new Cell('Reference Number'),
                new Cell('Name'),
                new Cell('Quantity'),
            ])
            ->data($lowstackdata)
            ->title('Out Of Stock Or Low stock Products')
            ->viewall(['label' => 'View All', 'link' => Nova::path().'/resources/products/lens/low-stock']),
        ];
    }

    // [
    //     (new Row(
    //         new Cell('2018091001'),
    //         (new Cell('20.50'))->class('text-right')->id('price-2')
    //     ))->viewLink('/resources/orders/1'),
    // ]

    /**
     * Get the extra dashboards that should be displayed on the Nova dashboard.
     *
     * @return array
     */
    protected function dashboards()
    {
        return [
        ];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {
        return [
            new NovaSettings,
            new NovaActivitylog(),
        ];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
