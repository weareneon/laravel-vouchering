<?php

use Illuminate\Database\Capsule\Manager as DB;
use Fastwebmedia\LaravelVouchering\Models\Campaign;

class CampaignFactoryTest extends BaseVoucherTest
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

        parent::setupBeforeClass();
        static::$fm->seed(5, 'Fastwebmedia\LaravelVouchering\Models\Campaign');
    }

    /** @test **/
        public function itCanCreateCampaign()
    {
        $factory = $this->getCampaignFactory();

        $data = [
            'name' => 'Test Campaign',
            'brand' => 'Test Brand',
            'urn' => '11002',
            'is_active' => 1
        ];

        $campaign = $factory->createCampaign($data);

        $this->assertInstanceOf('Fastwebmedia\LaravelVouchering\Models\Campaign', $campaign);
    }

    /** @test **/
    public function itPreventsInvalidCampaign()
    {
        $factory = $this->getCampaignFactory();

        Campaign::create([
            'name' => 'Test Campaign',
            'brand' => 'Test Brand',
            'urn' => '11003',
            'is_active' => 1
        ]);

        $data = [
            'name' => 'Test Campaign',
            'brand' => 'Test Brand',
            'urn' => '11003',
            'is_active' => 1
        ];

        $campaign = $factory->createCampaign($data);

        $this->assertFalse($campaign);
    }
}