<?php namespace Fastwebmedia\LaravelVouchering\Facades;

use Illuminate\Support\Facades\Facade;

class LaravelVouchering extends Facade {
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'voucher'; }
}