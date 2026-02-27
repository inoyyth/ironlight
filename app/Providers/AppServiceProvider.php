<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Register Blade components
        Blade::component('button', \App\View\Components\Button::class);
        Blade::component('card', \App\View\Components\Card::class);
        Blade::component('badge', \App\View\Components\Badge::class);
        Blade::component('alert', \App\View\Components\Alert::class);
        Blade::component('input', \App\View\Components\Input::class);
        Blade::component('table', \App\View\Components\Table::class);
        Blade::component('modal', \App\View\Components\Modal::class);
        Blade::component('pagination', \App\View\Components\Pagination::class);
        Blade::component('dropdown', \App\View\Components\Dropdown::class);
    }
}
