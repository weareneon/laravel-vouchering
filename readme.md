# Laravel Voucher Package

[![Build Status](https://travis-ci.org/fastwebmedia/laravel-vouchering.svg)](https://travis-ci.org/fastwebmedia/laravel-vouchering)

A simple voucher package to allow for the generation of unique vouchers across multiple campaigns, packaged up with create, load, redeem, expire, and delete methods.

## Installation (Laravel 5)

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

All done! You are now ready to set up your first voucher campaign!

## Installation (Laravel 4)

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

All done! You are now ready to set up your first voucher campaign!

## Setting up a new Campaign

Setting up a new voucher campaign is made easy using the package's campaign:create artisan command. Simply run in the terminal and follow the prompts.

```
php artisan campaign:create
```

Check your database, you should now have a new campaign.

## Coming Soon...

More documentation to follow, covering all package methods for voucher creation, loading and more...
