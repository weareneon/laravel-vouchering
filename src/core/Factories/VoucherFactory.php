<?php namespace Fastwebmedia\LaravelVouchering\core\Factories;

use \Fastwebmedia\LaravelVouchering\models\Voucher;
use \Fastwebmedia\LaravelVouchering\core\Repositories\CampaignRepository as CampaignRepository;

class VoucherFactory
{

    /**
     * @var Voucher
     */
    protected $voucher;

    /**
     * @var Campaign
     */
    protected $campaign;

    /**
     * Constructs models
     */
    public function __construct() {
        $this->voucher = New Voucher;
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

            $voucher = $this->voucher->create([
                'campaign_id' => $campaign->id,
                'hash' => $this->voucher->generateHash(),
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
