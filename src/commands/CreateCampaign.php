<?php

use Illuminate\Console\Command;
use \Fastwebmedia\LaravelVouchering\Factories\CampaignFactory;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;

class CampaignCreate extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'campaign:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set up a new voucher campaign.';

    /**
     * Create a new CampaignFactory instance.
     *
     * CampaignFactory instance
     *
     * @var CampaignFactory
     */
    protected $campaign;

    /**
     * Create a new CampaignCreateCommand instance.
     *
     * @param CampaignFactory $campaignFactory
     */
    public function __construct(CampaignFactory $campaignFactory)
    {
        parent::__construct();
        $this->campaign = $campaignFactory;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
        $this->line('Setting up your new Voucher Campaign...');

        $this->comment("Campaign Configuration:");

        $datestamp = date('my');
        if ( ! $name = $this->argument('name') ){
            $name = $this->ask('What is the name of your campaign?');
        }
        if ( ! $brand = $this->argument('brand') ){
            $brand = $this->ask('What is your campaign brand?');
        }
        if ( ! $urn = $this->argument('urn') ){
            $urn = Str::slug($name).'-'.$datestamp;

            $correctUrn = false;

            while (! $correctUrn) {
                if (! $this->confirm("Is '{$urn}' the URN you would like to use for the voucher campaign? [yes|no]", true)) {
                    $urn = $this->ask('Please enter a new campaign URN:');
                } else {
                    $correctUrn = true;
                }
            }
        }
        if ( ! $expiry_limit = $this->argument('expiry_limit') ){
            $expiry_limit = $this->ask('Please enter the voucher expiry for the campaign (days):');
        }

        $data = [
            'name' => $name,
            'brand' => $brand,
            'urn' => $urn,
            'expiry_limit' => $expiry_limit
        ];

        if (! $this->campaign->createCampaign($data)) {
            $this->comment("Oops, something went wrong. Please ensure the Voucher Campaign URN '{$urn}' is unique.");

            return;
        }

        $this->info("Voucher Campaign successfully created. Campaign URN is '{$urn}'.");
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::OPTIONAL, 'Name of campaign'],
            ['brand', InputArgument::OPTIONAL, 'Brand'],
            ['urn', InputArgument::OPTIONAL, 'URN'],
            ['expiry_limit', InputArgument::OPTIONAL, 'Voucher expiry limit']
        ];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [];
    }
}
