<?php

namespace LaraLeague\Package;

use Route;
use Illuminate\Support\ServiceProvider;

/**
 * Class PackageServiceProvider
 * @package LaraLeague\Package
 */
class PackageServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Application is booting
     */
    public function boot()
    {

        $this->registerViews();
        $this->registerMigrations();
        $this->registerAssets();
        $this->registerTranslations();
        $this->registerConfigurations();

        if(! $this->app->routesAreCached()) {
            $this->registerRoutes();
        }
    }

    /**
     * Register the package views
     */
    protected function registerViews()
    {
        // register views within the application with the set namespace
        $this->loadViewsFrom($this->packagePath('resources/views'), 'package');
        // allow views to be published to the storage directory
        $this->publishes([
            $this->packagePath('resources/views') => base_path('resources/views/lara-league/package'),
        ], 'views');
    }

    /**
     * Register the package migrations
     */
    protected function registerMigrations()
    {
        $this->publishes([
            $this->packagePath('database/migrations') => database_path('/migrations')
        ], 'migrations');
    }

    /**
     * Register the package public assets
     */
    protected function registerAssets()
    {
        $this->publishes([
            $this->packagePath('resources/assets') => public_path('lara-league/package'),
        ], 'public');
    }

    /**
     * Register the package translations
     */
    protected function registerTranslations()
    {
        $this->loadTranslationsFrom($this->packagePath('resources/lang'), 'package');
    }

    /**
     * Register the package configurations
     */
    protected function registerConfigurations()
    {
        $this->mergeConfigFrom(
            $this->packagePath('config/config.php'), 'package'
        );
        $this->publishes([
            $this->packagePath('config/config.php') => config_path('package.php'),
        ], 'config');
    }

    /**
     * Register the package routes
     *
     * @info use groups, specific routes
     * @see http://laravel.com/docs/5.1/routing
     */
    protected function registerRoutes()
    {
        Route::any('/package', [
            'as' => 'package:index',
            'uses' => 'LaraLeague\Package\Controllers\PackageController@index'
        ]);
    }

    /**
     * Loads a path relative to the package base directory
     *
     * @param string $path
     * @return string
     */
    protected function packagePath($path = '')
    {
        return sprintf("%s/%s", __DIR__ . '../', $path);
    }
}