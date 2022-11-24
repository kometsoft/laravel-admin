<?php

namespace Kometsoft\Tabler;

use Illuminate\Support\ServiceProvider;

class TablerServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/config/admin.php',
            'admin'
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            // Config file
            __DIR__ . '/config/admin.php' => config_path('admin.php'),

            // Stubs
            __DIR__ . '/../stubs/resources/views' => resource_path('views'),
        ], 'laravel-admin');
    }
}
