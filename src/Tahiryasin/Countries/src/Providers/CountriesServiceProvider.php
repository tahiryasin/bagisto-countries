<?php

namespace Tahiryasin\Countries\Providers;

use Illuminate\Support\ServiceProvider;

class CountriesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadRoutesFrom(__DIR__ . '/../Http/super-routes.php');
        $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'countries');
        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'countries');
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerConfig();
    }

    /**
     * Register package config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->mergeConfigFrom(
            dirname(__DIR__) . '/Config/super-menu.php', 'menu.super-admin'
        );

        $this->mergeConfigFrom(
            dirname(__DIR__) . '/Config/super-acl.php', 'super-acl'
        );

    }
}