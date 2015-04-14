<?php namespace Fastwebmedia\LaravelVouchering\Factories;

use Fastwebmedia\LaravelVouchering\Models\Campaign;
use Fastwebmedia\LaravelVouchering\Repositories\CampaignRepository;

class CampaignFactory
{
    /**
     * @var Campaign
     */
    protected $model;

    /**
     * @var CampaignRepository
     */
    protected $repo;

    /**
     * Constructs models.
     *
     * @param Campaign $model
     * @param CampaignRepository @campaignRepository
     */
    public function __construct(Campaign $model, CampaignRepository $campaignRepository)
    {
        $this->model = $model;
        $this->repo = $campaignRepository;
    }

    /**
     * createCampaign function.
     *
     * @access public
     *
     * @param array $data
     *
     * @return Campaign
     */
    public function createCampaign($data)
    {
        $urn = $data['urn'];

        // Check campaign already exists
        if (! $this->repo->loadCampaign($urn) && $urn != '') {
            $campaign = $this->model->create($data);

            return $campaign;
        }

        return false;
    }

    /**
     * destroyCampaign function.
     *
     * @access public
     *
     * @param string $urn
     *
     * @return Campaign
     */
    public function destroyCampaign($urn)
    {
        if ($campaign = $this->model->where('urn', '=', $urn)->first()) {
            if ($campaign->delete()) {
                return $campaign;
            }
        }

        return false;
    }
}
