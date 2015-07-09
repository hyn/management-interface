<?php

namespace LaraLeague\Package;

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

        $this->registerRoutes();
    }

    /**
     * Register the package views
     */
    protected function registerViews()
    {
        // register views within the application with the set namespace
        $this->loadViewsFrom($this->packagePath('assets/views'), 'package');
        // allow views to be published to the storage directory
        $this->publishes([
            $this->packagePath('assets/views') => base_path('resources/views/lara-league/package'),
        ], 'views');
    }

    /**
     * Register the package migrations
     */
    protected function registerMigrations()
    {
        $this->publishes([
            $this->packagePath('assets/migrations') => database_path('/migrations')
        ], 'migrations');
    }

    /**
     * Register the package public assets
     */
    protected function registerAssets()
    {
        $this->publishes([
            $this->packagePath('/assets/public') => public_path('lara-league/package'),
        ], 'public');
    }

    /**
     * Register the package translations
     */
    protected function registerTranslations()
    {
        $this->loadTranslationsFrom($this->packagePath('assets/translations'), 'package');
    }

    /**
     * Register the package configurations
     */
    protected function registerConfigurations()
    {
        $this->mergeConfigFrom(
            $this->packagePath('assets/configurations/config.php'), 'package'
        );
        $this->publishes([
            $this->packagePath('assets/configurations/config.php') => config_path('package.php'),
        ], 'config');
    }

    /**
     * Register the package routes
     */
    protected function registerRoutes()
    {
        require_once {$this->packagePath('assets/routes.php')};
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