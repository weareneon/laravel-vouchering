<?php namespace Fastwebmedia\LaravelVouchering\Factories;

use Fastwebmedia\LaravelVouchering\models\Campaign;
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
     *
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
        // Check campaign already exists
        if (! $this->repo->getCampaign($data['urn'])) {
            $campaign = $this->model->create($data);

            return $campaign;
        }

        return false;
    }
}
