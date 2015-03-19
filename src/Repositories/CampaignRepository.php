<?php namespace Fastwebmedia\LaravelVouchering\Repositories;

use Fastwebmedia\LaravelVouchering\Models\Campaign;

class CampaignRepository
{
    /**
     * @var Voucher
     */
    protected $model;

    /**
     * Constructs models.
     *
     * @param Campaign $model
     */
    public function __construct(Campaign $model)
    {
        $this->model = $model;
    }

    /**
     * loadCampaign function.
     *
     * @access public
     *
     * @param string $urn
     *
     * @return Campaign
     */
    public function loadCampaign($urn)
    {
        $campaign = $this->model->where('urn', '=', $urn)->first();

        if ( $campaign ){
            return $campaign;
        }

        return false;
    }
}
