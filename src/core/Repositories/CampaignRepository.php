<?php namespace Fastwebmedia\LaravelVouchering\core\Repositories;

use \Fastwebmedia\LaravelVouchering\models\Campaign;

class CampaignRepository
{
    /**
     * @var Voucher
     */
    protected $model;

    public function __construct()
    {
        $this->model = New Campaign;
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
