<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redis;

class SeoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Share SEO data globally with all views
        View::composer('*', function ($view) {
            $seoSettings = Redis::get('seo_settings');
            $seoData = $seoSettings ? json_decode($seoSettings, true) : [];
            
            // Make SEO data available globally
            $view->with('globalSeo', $seoData);
        });
    }
}
