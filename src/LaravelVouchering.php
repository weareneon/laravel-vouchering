<?php namespace Fastwebmedia\LaravelVouchering;

use \Fastwebmedia\LaravelVouchering\Factories\VoucherFactory;
use \Fastwebmedia\LaravelVouchering\Repositories\VoucherRepository;

class LaravelVouchering {

    /**
     * @var VoucherFactory
     */
    protected $factory;

    /**
     * @var VoucherRepository
     */
    protected $repo;

    public function __construct(VoucherFactory $factory, VoucherRepository $repository) {
        $this->factory = $factory;
        $this->repository = $repository;
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
        return $this->repository->loadVoucher($hash);
    }

    // expires voucher by hash
    public function expireVoucher($hash){
        return $this->repository->expireVocuher($hash);
    }

    // redeems voucher by hash
    public function redeemVoucher($hash){
        return $this->repository->redeemVoucher($hash);
    }

    // checks voucher expiry status
    public function checkExpiry($date, $days){
        return $this->repository->checkExpiry($date, $days);
    }

}