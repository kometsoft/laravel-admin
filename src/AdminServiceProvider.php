<?php

namespace Kometsoft\Admin;

use Illuminate\Support\ServiceProvider;
use App\Console\Commands\InstallAdminCommand;

class AdminServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/config/laravel-admin.php',
            'laravel-admin'
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
            __DIR__ . '/config/laravel-admin.php' => config_path('laravel-admin.php'),

            // Stubs
            __DIR__ . '/../stubs/app' => base_path('app'),
            __DIR__ . '/../stubs/database' => base_path('database'),
            __DIR__ . '/../stubs/resources/views' => base_path('resources/views'),
            __DIR__ . '/../stubs/routes' => base_path('routes'),
            __DIR__ . '/../stubs/stubs' => base_path('stubs'),
        ], 'laravel-admin');

        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallAdminCommand::class,
            ]);
        }
    }
}
