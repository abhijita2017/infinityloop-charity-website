<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Models\Setting;

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
        Paginator::useBootstrap();

        // Only load settings if not in console mode and database is accessible
        if (!$this->app->runningInConsole()) {
            try {
                $setting_data = Setting::where('id',1)->first();
                view()->share('global_setting_data', $setting_data);
            } catch (\Exception $e) {
                // Silently fail if database is not accessible
                view()->share('global_setting_data', null);
            }
        }

    }
}
