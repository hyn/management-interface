<?php namespace HynMe\ManagementInterface;

use Illuminate\Support\ServiceProvider;

use Config;
class ManagementInterfaceServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

    public function boot()
    {
        $this->mergeConfigFrom(__DIR__.'/../../config/management-interface.php', 'management-interface');

        $this->loadViewsFrom(__DIR__.'/../../views', Config::get('management-interface.views-namespace'));

        \View::share('_hyn_mi_view_namespace', Config::get('management-interface.views-namespace'));
    }

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		//
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
