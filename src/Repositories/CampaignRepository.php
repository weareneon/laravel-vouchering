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
     * getCampaign function.
     *
     * @access public
     *
     * @param string $urn
     *
     * @return Campaign
     */
    public function getCampaign($urn)
    {
        return $this->model->where('urn', '=', $urn)->first();
    }
}
