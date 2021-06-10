<?php

namespace Malezha\SypexGeo;

use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;

class ServiceProvider extends IlluminateServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/sxgeo.php' => config_path('sxgeo.php'),
        ], 'config');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(SxGeo::class, function () {
            $config = $this->app['config'];

            return new SxGeo($config->get('sxgeo.database'), $config->get('sxgeo.type'));
        });

        $this->app->alias(SxGeo::class, 'sxgeo');
    }
}