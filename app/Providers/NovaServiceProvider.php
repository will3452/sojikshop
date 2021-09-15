<?php

namespace App\Providers;

use App\Nova\Metrics\NumberOfBanners;
use App\Nova\Metrics\NumberOfCategories;
use App\Nova\Metrics\NumberOfProducts;
use App\Nova\Metrics\NumberOfUsers;
use Bolechen\NovaActivitylog\NovaActivitylog;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Fields\Code;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;
use NumaxLab\NovaCKEditor5Classic\CKEditor5Classic;
use OptimistDigital\NovaSettings\NovaSettings;

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

            Code::make('Facebook scripts'),

            Text::make('Copyright'),
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
            return in_array($user->email, [
                'superadmin@sojikshop.store',
            ]);
        });
    }

    /**
     * Get the cards that should be displayed on the default Nova dashboard.
     *
     * @return array
     */
    protected function cards()
    {
        return [
            NumberOfProducts::make(),
            NumberOfCategories::make(),
            NumberOfBanners::make(),
            NumberOfUsers::make(),
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
