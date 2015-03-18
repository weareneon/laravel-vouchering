<?php

use Illuminate\Database\Capsule\Manager as DB;

class VoucherFactoryTest extends BaseVoucherTest
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
        static::$fm->seed(5, 'Fastwebmedia\LaravelVouchering\Models\Voucher');
    }

    /** @test **/
        public function itCanCreateVoucher()
    {
        $campaignFactory = $this->getCampaignFactory();

        $testData = [
            'name' => 'Test Campaign',
            'brand' => 'Test Brand',
            'urn' => '11002',
            'is_active' => 1
        ];

        $campaign = $campaignFactory->createCampaign($testData);

        $voucherFactory = $this->getVoucherFactory();

        $voucher = $voucherFactory->createVoucher($testData['urn']);

        $this->assertInstanceOf('Fastwebmedia\LaravelVouchering\Models\Voucher', $voucher);
    }

    /** @test **/
    public function itPreventsVoucherCreationForInvalidCampaign()
    {
        $voucherFactory = $this->getVoucherFactory();

        $voucher = $voucherFactory->createVoucher('fakecampaign101');

        $this->assertFalse($voucher);
    }
}