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
    }

    /**
     * Register the package views
     */
    protected function registerViews()
    {
        // register views within the application with the set namespace
        $this->loadViewsFrom($this->packagePath('views'), 'package');
        // allow views to be published to the storage directory
        $this->publishes([
            $this->packagePath('views') => base_path('resources/views/lara-league/package'),
        ]);
    }

    /**
     * Register the package migrations
     */
    protected function registerMigrations()
    {

    }

    /**
     * Register the package public assets
     */
    protected function registerAssets()
    {

    }

    /**
     * Loads a path relative to the package base directory
     * @param string $path
     * @return string
     */
    protected function packagePath($path = '')
    {
        return sprintf("%s/%s", __DIR__ . '../', $path);
    }
}