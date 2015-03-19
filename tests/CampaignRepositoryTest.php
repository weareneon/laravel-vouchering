<?php

use Illuminate\Database\Capsule\Manager as DB;
use Fastwebmedia\LaravelVouchering\Models\Campaign;

class CampaignRepositoryTest extends BaseVoucherTest
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

        parent::setupBeforeClass();
        static::$fm->seed(5, 'Fastwebmedia\LaravelVouchering\Models\Campaign');
    }

    /** @test **/
    public function itCanGetCampaign()
    {
        $repo = $this->getCampaignRepository();

        Campaign::create([
            'name' => 'Test Campaign',
            'brand' => 'Test Brand',
            'urn' => '11002',
            'is_active' => 1
        ]);

        $campaign = $repo->loadCampaign('11002');

        $this->assertInstanceOf('Fastwebmedia\LaravelVouchering\Models\Campaign', $campaign);
        $this->assertEquals('11002', $campaign->urn);
    }
}