<?php

use League\FactoryMuffin\Faker\Facade as Faker;

$fm->define('Fastwebmedia\LaravelVouchering\Models\Campaign')->setDefinitions([
    'name' => Faker::name(),
    'brand' => Faker::name(),
    'urn' => Faker::ean8(),
    'expiry_limit' => '14',
    'is_active' => 1
]);

$fm->define('Fastwebmedia\LaravelVouchering\Models\Voucher')->setDefinitions([
    'hash' => Faker::ean8(),
    'campaign_id' => 1,
    'is_redeemed' => '0',
    'redeemed_at' => '0000-00-00:00-00-00',
    'is_expired' => '0',
    'expired_at' => '0000-00-00:00-00-00',
    'is_valid' => '1'
]);