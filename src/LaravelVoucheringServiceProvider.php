<?php namespace Fastwebmedia\LaravelVouchering;

use Fastwebmedia\LaravelVouchering\Repositories\CampaignRepository;
use Fastwebmedia\LaravelVouchering\Models\Campaign;
use Fastwebmedia\LaravelVouchering\Models\Voucher;
use Fastwebmedia\LaravelVouchering\Factories\VoucherFactory;
use Fastwebmedia\LaravelVouchering\Repositories\VoucherRepository;
use Illuminate\Support\ServiceProvider;

class LaravelVoucheringServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Boot the service provider.
     */
    public function boot()
    {
        $this->migrate();
    }

    /**
     * Copy up package migrations.
     */
    public function migrate()
    {
        $this->publishes([
            realpath(__DIR__.'/migrations/') => base_path('/database/migrations'),
        ], 'migrations');
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->app['voucher'] = $this->app->share(function ($app) {
            return new LaravelVouchering(new VoucherFactory(new Voucher(), new CampaignRepository(new Campaign())), new VoucherRepository(new Voucher()));
        });

        // adds alias for app
        $this->app->booting(function () {
            $loader = \Illuminate\Foundation\AliasLoader::getInstance();
            $loader->alias('Voucher', 'Fastwebmedia\LaravelVouchering\Facades\LaravelVouchering');
        });

        $this->app['command.package.command'] = $this->app->share(function ($app) {
            return new \CampaignCreate($app->make('Fastwebmedia\LaravelVouchering\Factories\CampaignFactory'));
        });

        $this->commands('command.package.command');
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
