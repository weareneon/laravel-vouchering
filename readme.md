# Laravel Voucher Package

[![Build Status](https://travis-ci.org/fastwebmedia/laravel-vouchering.svg)](https://travis-ci.org/fastwebmedia/laravel-vouchering)

A simple voucher package to allow for the generation of unique vouchers across multiple campaigns, packaged up with create, load, redeem, expire, and delete methods.

## <a name="l5 install"></a> Installation (Laravel 5)

Here are the steps you need to take to install the package on Laravel 5. [Click here for Laravel 4](#l4install).

Add the package (v2.*) to your composer.json require.


```
composer require fastwebmedia/laravel-vouchering:2.*
```

Run composer update.

```
composer update
```

Add the service provider to providers array in app.php config.

```
'Fastwebmedia\LaravelVouchering\LaravelVoucheringServiceProvider'
```

Now run the publish command to copy up the package migrations for the voucher and campaign tables and then migrate to your hearts content.

```
vendor:publish
php artisan migrate
```

All done! You are now ready to [set up your first voucher campaign](#campaign-create)!

## <a name="campaign-create"></a> Setting up a new Campaign

Setting up a new voucher campaign is made easy using the package's campaign:create artisan command. Simply run in the terminal and follow the prompts.

```
php artisan campaign:create
```

Check your database, you should now have a new campaign.

## <a name="l4install"></a> Installation (Laravel 4)

Here are the steps you need to take to install the package on Laravel 4. [Click here for Laravel 5](#l5install).

Add the package (v1.*) to your composer.json require. 

```
composer require fastwebmedia/laravel-vouchering:1.*
```

Run composer update.

```
composer update
```

Add the service provider to providers array in app.php config.

```
'Fastwebmedia\LaravelVouchering\LaravelVoucheringServiceProvider'
```

From the terminal run the package migrations.

```
php artisan migrate --package="fastwebmedia/laravel-vouchering"
```

All done! You are now ready to [set up your first voucher campaign](#campaign-create)!

## Coming Soon...

More documentation to follow, covering all package methods for voucher creation, loading and more...
