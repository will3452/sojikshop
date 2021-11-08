<?php

namespace App\Providers;

use App\Models\Order;
use Laravel\Nova\Nova;
use Laravel\Nova\Fields\Code;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Image;
use App\Nova\Metrics\NumberOfUsers;
use Illuminate\Support\Facades\Gate;
use App\Nova\Metrics\NumberOfBanners;
use App\Nova\Metrics\NumberOfProducts;
use App\Nova\Metrics\NumberOfCategories;
use Bolechen\NovaActivitylog\NovaActivitylog;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Textarea;
use OptimistDigital\NovaSettings\NovaSettings;
use Laravel\Nova\NovaApplicationServiceProvider;
use NumaxLab\NovaCKEditor5Classic\CKEditor5Classic;
use Coroowicaksono\ChartJsIntegration\LineChart;

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

            CKEditor5Classic::make('Data Privacy')
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
        $salestotal = Order::TOTALSALES();
        $data = [];
        foreach ($salestotal as $key => $value) {
            $total = 0;
            foreach ($value as $item) {
                $total += json_decode($item->items)->summary->total;
            }
            $data[] = $total;
        }
        $categories = $salestotal->keys();
        return [
            (new LineChart())
                ->title('Sales')
                ->animations([
                    'enabled' => true,
                    'easing' => 'easeinout',
                ])
                ->series(array([
                    'barPercentage' => 0.5,
                    'label' => 'Sales',
                    'borderColor' => '#90ed7d',
                    'data' => $data,
                ]))
                ->options([
                    'xaxis' => [
                        'categories' => $categories
                    ],
                ])
                ->width('2/3'),
            NumberOfProducts::make(),
            NumberOfCategories::make(),
            NumberOfBanners::make(),

        ];
    }

    /**
     * Get the extra dashboards that should be displayed on the Nova dashboard.
     *
     * @return array
     */
    protected function dashboards()
    {
        return [];
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
