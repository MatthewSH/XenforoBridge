<?php namespace XenforoBridge;

use Illuminate\Support\ServiceProvider;

class XenforoBridgeServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{

		$this->app->singleton('XenforoBridge', function($app)
                {
                    $app['XenforoBridge.loaded'] = true;

                    $xenforoDir = $app['config']->get('xenforobridge::xenforo_directory_path');
                    $xenforoBaseUrl = $app['config']->get('xenforobridge::xenforo_base_url_path');
                    return new XenforoBridge($xenforoDir, $xenforoBaseUrl);
                });
	}
        
        public function boot()
        {
            //Initialize package
            $this->package('urb/xenforobridge',null, __DIR__.'/../');

            //include our filters
			include __DIR__.'/../filters.php';      

        }

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('XenforBridge');
	}

}
