<?php namespace Fastwebmedia\LaravelVouchering;

use \Fastwebmedia\LaravelVouchering\core\Factories\VoucherFactory as Factory;
use \Fastwebmedia\LaravelVouchering\core\Repositories\VoucherRepository as Repository;

class LaravelVouchering {

    /**
     * @var Factory
     */
    protected $factory;

    /**
     * @var Repository
     */
    protected $repo;

    public function __construct() {
        $this->factory = New Factory;
        $this->repo = New Repository;
    }

    // created voucher for specified campaign (urn)
    public function createVoucher($campaignUrn){
        return $this->factory->createVoucher($campaignUrn);
    }

    // destroys voucher by hash
    public function destroyVoucher($hash){
        return $this->factory->destroyVoucher($hash);
    }

    // loads voucher by hash
    public function loadVoucher($hash){
        return $this->repo->loadVoucher($hash);
    }

    // expires voucher by hash
    public function expireVoucher($hash){
        return $this->repo->expireVocuher($hash);
    }

    // redeems voucher by hash
    public function redeemVoucher($hash){
        return $this->repo->redeemVoucher($hash);
    }

}