<?php

use Fastwebmedia\LaravelVouchering\Factories\VoucherFactory;
use Fastwebmedia\LaravelVouchering\Factories\CampaignFactory;
use Fastwebmedia\LaravelVouchering\Models\Voucher;
use Fastwebmedia\LaravelVouchering\Models\Campaign;
use Fastwebmedia\LaravelVouchering\Repositories\CampaignRepository;
use Fastwebmedia\LaravelVouchering\Repositories\VoucherRepository;

abstract class BaseVoucherTest extends AbstractFWMTestCase
{
    /**
     * @return VoucherFactory
     */
    protected function getVoucherFactory()
    {
        return new VoucherFactory(new Voucher(), new CampaignRepository(new Campaign()));
    }

    /**
     * @return VoucherRepository
     */
    protected function getVoucherRepository()
    {
        return new VoucherRepository(new Voucher);
    }

    /**
     * @return CampaignFactory
     */
    protected function getCampaignFactory()
    {
        return new CampaignFactory(new Campaign(), new CampaignRepository(new Campaign()));
    }

    /**
     * @return CampaignRepository
     */
    protected function getCampaignRepository()
    {
        return new CampaignRepository(new Campaign);
    }
}
