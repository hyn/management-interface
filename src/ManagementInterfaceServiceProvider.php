<?php

namespace HynMe\ManagementInterface;

use Illuminate\Support\ServiceProvider;
use Laraflock\Dashboard\Providers\DashboardServiceProvider;

/**
 * Class PackageServiceProvider.
 *
 * @see http://laravel.com/docs/5.1/packages#service-providers
 * @see http://laravel.com/docs/5.1/providers
 */
class ManagementInterfaceServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @see http://laravel.com/docs/5.1/providers#deferred-providers
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @see http://laravel.com/docs/5.1/providers#the-register-method
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(DashboardServiceProvider::class);
    }

    /**
     * Application is booting.
     *
     * @see http://laravel.com/docs/5.1/providers#the-boot-method
     *
     * @return void
     */
    public function boot()
    {
        $this->registerViews();
        $this->registerTranslations();
        $this->registerConfigurations();

        if (! $this->app->routesAreCached() && config('management-interface.routes')) {
            $this->registerRoutes();
        }

        $this->registerAsDashboardModule();
    }

    /**
     * Register the package views.
     *
     * @see http://laravel.com/docs/5.1/packages#views
     *
     * @return void
     */
    protected function registerViews()
    {
        // register views within the application with the set namespace
        $this->loadViewsFrom($this->packagePath('resources/views'), 'management-interface');
        // allow views to be published to the storage directory
        $this->publishes([
            $this->packagePath('resources/views') => base_path('resources/views/hyn-me/management-interface'),
        ], 'views');
    }

    /**
     * Register the package translations.
     *
     * @see http://laravel.com/docs/5.1/packages#translations
     *
     * @return void
     */
    protected function registerTranslations()
    {
        $this->loadTranslationsFrom($this->packagePath('resources/lang'), 'management-interface');
    }

    /**
     * Register the package configurations.
     *
     * @see http://laravel.com/docs/5.1/packages#configuration
     *
     * @return void
     */
    protected function registerConfigurations()
    {
        $this->mergeConfigFrom(
            $this->packagePath('config/config.php'), 'management-interface'
        );
        $this->publishes([
            $this->packagePath('config/config.php') => config_path('management-interface.php'),
        ], 'config');
    }

    /**
     * Register the package routes.
     *
     * @warn consider allowing routes to be disabled
     *
     * @see http://laravel.com/docs/5.1/routing
     * @see http://laravel.com/docs/5.1/packages#routing
     *
     * @return void
     */
    protected function registerRoutes()
    {
        $this->app['router']->group([
            'prefix'    => 'dashboard/multi-tenant',
            'namespace' => 'HynMe\ManagementInterface\Http\Controllers',
            'as'        => 'management-interface.',
        ], function () {
            /*
             * Dashboard specific routes
             * @uses HynMe\ManagementInterface\Controllers\DashboardController
             */
            $this->app['router']->any('dashboard', [
                'as'   => 'dashboard.index',
                'uses' => 'DashboardController@index',
            ]);
            /*
             * Website model binding
             */
            $this->app['router']->model('website', 'Laraflock\MultiTenant\Models\Website');
            /*
             * Website specific routes
             * @uses HynMe\ManagementInterface\Controllers\WebsiteController
             */
            $this->app['router']->any('websites', [
                'as'   => 'website.index',
                'uses' => 'WebsiteController@index',
            ]);
            $this->app['router']->any('website/{website}/{name}', [
                'as'   => 'website.read',
                'uses' => 'WebsiteController@read',
            ]);
            $this->app['router']->get('website/create', [
                'as'   => 'website.create',
                'uses' => 'WebsiteController@create',
            ]);
            $this->app['router']->post('website/create', [
                'as'   => 'website.store',
                'uses' => 'WebsiteController@store',
            ]);
            $this->app['router']->any('website/{website}/{name}/delete', [
                'as'   => 'website.delete',
                'uses' => 'WebsiteController@delete',
            ]);
            $this->app['router']->get('website/{website}/{name}/update', [
                'as'   => 'website.edit',
                'uses' => 'WebsiteController@edit',
            ]);
            $this->app['router']->post('website/{website}/{name}/update', [
                'as'   => 'website.update',
                'uses' => 'WebsiteController@update',
            ]);
            $this->app['router']->post('ajax/websites', [
                'as'   => 'website.ajax',
                'uses' => 'WebsiteController@ajax',
            ]);
            $this->app['router']->any('website/{website}/{name}/save-configurations', [
                'as'   => 'website.save-configurations',
                'uses' => 'WebsiteController@saveConfigurations',
            ]);
            /*
             * Hostname model binding
             */
            $this->app['router']->model('hostname', 'Laraflock\MultiTenant\Models\Hostname');
            /*
             * Hostname specific routes
             * @uses HynMe\ManagementInterface\Controllers\HostnameController
             */
            $this->app['router']->get('website/{website}/{name}/add-hostname', [
                'as'   => 'hostname.add',
                'uses' => 'HostnameController@add',
            ]);
            $this->app['router']->post('website/{website}/{name}/add-hostname', [
                'as'   => 'hostname.added',
                'uses' => 'HostnameController@added',
            ]);
            $this->app['router']->get('hostname/{hostname}/{name}/delete', [
                'as'   => 'hostname.delete',
                'uses' => 'HostnameController@delete',
            ]);
            $this->app['router']->delete('hostname/{hostname}/{name}/delete', [
                'as'   => 'hostname.deleted',
                'uses' => 'HostnameController@deleted',
            ]);
            $this->app['router']->any('hostname/{hostname}/{name}/update', [
                'as'   => 'hostname.update',
                'uses' => 'HostnameController@update',
            ]);
            $this->app['router']->post('ajax/hostnames', [
                'as'   => 'hostname.ajax',
                'uses' => 'HostnameController@ajax',
            ]);
            /*
             * Tenant model binding
             */
            $this->app['router']->model('tenant', 'Laraflock\MultiTenant\Models\Tenant');
            /*
             * Tenant specific routes
             * @uses HynMe\ManagementInterface\Controllers\TenantController
             */
            $this->app['router']->any('tenants', [
                'as'   => 'tenant.index',
                'uses' => 'TenantController@index',
            ]);
            $this->app['router']->get('tenant/create', [
                'as'   => 'tenant.create',
                'uses' => 'TenantController@create',
            ]);
            $this->app['router']->post('tenant/create', [
                'as'   => 'tenant.store',
                'uses' => 'TenantController@store',
            ]);
            $this->app['router']->post('ajax/tenants', [
                'as'   => 'tenant.ajax',
                'uses' => 'TenantController@ajax',
            ]);

            /*
             * Ssl model binding
             * @requires hyn-me/webserver
             */
            $this->app['router']->model('ssl', 'HynMe\Webserver\Models\SslCertificate');
            /*
             * Ssl specific routes
             * @uses HynMe\ManagementInterface\Controllers\SslController
             * @requires hyn-me/webserver
             */
            $this->app['router']->any('ssl', [
                'as'   => 'ssl.index',
                'uses' => 'SslController@index',
            ]);
            $this->app['router']->any('ssl/{ssl}', [
                'as'   => 'ssl.read',
                'uses' => 'SslController@read',
            ]);
            $this->app['router']->any('ssl/{ssl}/delete', [
                'as'   => 'ssl.delete',
                'uses' => 'SslController@delete',
            ]);

        });
    }

    /**
     * Loads a path relative to the package base directory.
     *
     * @param string $path
     *
     * @return string
     */
    protected function packagePath($path = '')
    {
        return sprintf('%s/%s', __DIR__.'/..', $path);
    }

    /**
     * Registers module as DashboardModule.
     */
    private function registerAsDashboardModule()
    {
        /** @var \Laraflock\Dashboard\Repositories\Module\ModuleRepositoryInterface $moduleRepository */
        $moduleRepository = $this->app->make('Laraflock\Dashboard\Repositories\Module\ModuleRepositoryInterface');
        $moduleRepository->register(new DashboardModule());
    }
}
