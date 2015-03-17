<?php namespace Fastwebmedia\LaravelVouchering;

use \Fastwebmedia\LaravelVouchering\core\Factories\VoucherFactory;
use \Fastwebmedia\LaravelVouchering\core\Repositories\VoucherRepository;

class LaravelVouchering {

    /**
     * @var VoucherFactory
     */
    protected $factory;

    /**
     * @var VoucherRepository
     */
    protected $repo;

    public function __construct() {
        $this->factory = New VoucherFactory;
        $this->repo = New VoucherRepository;
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