<?php

use Illuminate\Database\Capsule\Manager as DB;
use Fastwebmedia\LaravelVouchering\Models\Voucher;

class VoucherModelTest extends BaseVoucherTest
{
    public static function setupBeforeClass()
    {
        $db = new DB();
        $db->addConnection([
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);
        $db->setAsGlobal();
        $db->bootEloquent();
        $db->schema()->create('voucher_campaigns', function ($table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name');
            $table->string('brand');
            $table->string('urn')->unique();
            $table->integer('expiry_limit')->default('14');
            $table->boolean('is_active')->default('1');
        });
        $db->schema()->create('voucher_entries', function ($table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('hash')->unique();
            $table->integer('campaign_id');
            $table->boolean('is_redeemed')->default('0');
            $table->datetime('redeemed_at')->default('0000-00-00 00:00:00');
            $table->boolean('is_expired')->default('0');
            $table->datetime('expired_at')->default('0000-00-00 00:00:00');
            $table->boolean('is_valid')->default('1');
        });

        parent::setupBeforeClass();
        static::$fm->seed(5, 'Fastwebmedia\LaravelVouchering\Models\Campaign');
    }

    /** @test **/
    public function itCanGetDefaultCampaignExpiryDate()
    {
        $repo = $this->getVoucherRepository();

        Voucher::create([
            'hash' => 'voucher001',
            'campaign_id' => 1,
        ]);

        $voucher = $repo->loadVoucher('voucher001');

        $campaign_expiry_limit = $voucher->campaign->expiry_limit;
        $expected_date = date('Y-m-d H:i:s', strtotime($voucher->created_at.' + '.$campaign_expiry_limit.' days'));

        $expiryDate = $voucher->getExpiryDate();

        $this->assertEquals($expected_date, $expiryDate);
    }

    /** @test **/
    public function itCanGetCustomCampaignExpiryDate()
    {
        $repo = $this->getVoucherRepository();

        Voucher::create([
            'hash' => 'voucher002',
            'campaign_id' => 1,
        ]);

        $voucher = $repo->loadVoucher('voucher002');

        $expected_date = date('Y-m-d H:i:s', strtotime($voucher->created_at.' + 5 days'));

        $expiryDate = $voucher->getExpiryDate('5');

        $this->assertEquals($expected_date, $expiryDate);
    }
}
