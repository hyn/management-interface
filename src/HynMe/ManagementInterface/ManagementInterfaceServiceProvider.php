<?php namespace HynMe\ManagementInterface;

use Illuminate\Support\ServiceProvider;

use Config, Request, URL;


class ManagementInterfaceServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

    public function boot()
    {
        // translations
        $this->loadTranslationsFrom(__DIR__.'/../../lang', 'management-interface');
        // adds views
        $this->loadViewsFrom(__DIR__.'/../../views', 'management-interface');

        // extend tenant view
        $this->extendTenantView();
    }

    protected function extendTenantView()
    {
        // set management interface view namespace in HynMe tenant view
        $this->app->make('tenant.view')->put('mi-read-only', env('HYN_READ_ONLY') && !in_array(Request::ip(), explode(',', env('HYN_READ_ONLY_WHITELIST'))));
        $this->app->make('tenant.view')->put('current_url', URL::current());
    }

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return [];
	}

}
