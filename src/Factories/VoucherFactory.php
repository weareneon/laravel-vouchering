<?php namespace Fastwebmedia\LaravelVouchering\Factories;

use \Fastwebmedia\LaravelVouchering\Models\Voucher;
use \Fastwebmedia\LaravelVouchering\Repositories\CampaignRepository;

class VoucherFactory
{

    /**
     * @var Voucher
     */
    protected $model;

    /**
     * @var CampaignRepository
     */
    protected $campaignRepo;

    /**
     * Constructs models
     *
     * @param Voucher $model
     *
     * @param CampaignRepository @campaignRepository
     */
    public function __construct(Voucher $model, CampaignRepository $campaignRepository) {
        $this->model = $model;
        $this->campaignRepo = $campaignRepository;
    }

    /**
     * createVoucher function.
     *
     * @access public
     *
     * @param string $campaignUrn
     *
     * @return Voucher
     */
    public function createVoucher($campaignUrn)
    {
        // Check for valid campaign
        if ($campaign = $this->campaignRepo->getCampaign($campaignUrn)) {

            $voucher = $this->model->create([
                'campaign_id' => $campaign->id,
                'hash' => $this->model->generateHash(),
            ]);

            return $voucher;
        }

        return false;
    }

    /**
     * destroyVoucher function.
     *
     * @access public
     *
     * @param string $hash
     *
     * @return Voucher
     */
    public function destroyVoucher($hash)
    {
        if ($voucher = $this->model->where('hash', '=', $hash)->first()) {
            if ($voucher->delete()) {
                return $voucher;
            }
        }

        return false;
    }
}
