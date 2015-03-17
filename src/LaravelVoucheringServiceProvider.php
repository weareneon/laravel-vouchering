<?php namespace Fastwebmedia\LaravelVouchering;

use Illuminate\Support\ServiceProvider;

class LaravelVoucheringServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('fastwebmedia/laravel-vouchering');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
        $this->app['voucher'] = $this->app->share(function($app)
        {
            return new LaravelVouchering;
        });

        // adds alias for app
        $this->app->booting(function()
        {
            $loader = \Illuminate\Foundation\AliasLoader::getInstance();
            $loader->alias('Voucher', 'Fastwebmedia\LaravelVouchering\Facades\LaravelVouchering');
        });
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}
