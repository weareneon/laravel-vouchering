<?php

use Illuminate\Database\Capsule\Manager as DB;
use Fastwebmedia\LaravelVouchering\Models\Voucher;

class VoucherRepositoryTest extends BaseVoucherTest
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
    public function itCanLoadVoucher()
    {
        $repo = $this->getVoucherRepository();

        Voucher::create([
            'hash' => 'test001',
            'campaign_id' => 1
        ]);

        $voucher = $repo->loadVoucher('test001');

        $this->assertInstanceOf('Fastwebmedia\LaravelVouchering\Models\Voucher', $voucher);
        $this->assertEquals('test001', $voucher->hash);
    }

    /** @test **/
    public function itPreventsInvalidVoucherLoad()
    {
        $repo = $this->getVoucherRepository();

        Voucher::create([
            'hash' => 'test002',
            'campaign_id' => 1
        ]);

        $voucher = $repo->loadVoucher('invalid001');

        $this->assertFalse($voucher);
    }

    /** @test **/
    public function itCanExpireVoucher()
    {
        $repo = $this->getVoucherRepository();

        Voucher::create([
            'hash' => 'expire001',
            'campaign_id' => 1
        ]);

        $voucher = $repo->expireVoucher('expire001');

        $this->assertInstanceOf('Fastwebmedia\LaravelVouchering\Models\Voucher', $voucher);
        $this->assertEquals('1', $voucher->is_expired);
    }

    /** @test **/
    public function itCanRedeemVoucher()
    {
        $repo = $this->getVoucherRepository();

        Voucher::create([
            'hash' => 'redeem001',
            'campaign_id' => 1
        ]);

        $voucher = $repo->redeemVoucher('redeem001');

        $this->assertInstanceOf('Fastwebmedia\LaravelVouchering\Models\Voucher', $voucher);
        $this->assertEquals('1', $voucher->is_redeemed);
    }
}