<?php namespace Fastwebmedia\LaravelVouchering\core\Factories;

use \Fastwebmedia\LaravelVouchering\models\Voucher;
use \Fastwebmedia\LaravelVouchering\core\Repositories\CampaignRepository as CampaignRepository;

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
     */
    public function __construct() {
        $this->model = New Voucher;
        $this->campaignRepo = New CampaignRepository;
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
        if ($campaign = $this->campaignRepo->getCampaign($campaignUrn)):

            $voucher = $this->model->create([
                'campaign_id' => $campaign->id,
                'hash' => $this->model->generateHash(),
            ]);

            return $voucher;
        endif;

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
        if ($voucher = $this->model->where('hash', '=', $hash)->first()):
            if ($voucher->delete()):
                return $voucher;
            endif;
        endif;

        return false;
    }
}
