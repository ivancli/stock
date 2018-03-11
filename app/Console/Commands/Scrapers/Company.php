<?php

namespace Stock\Console\Commands\Scrapers;

use Illuminate\Console\Command;
use Stock\Contracts\Models\Base\MarketContract;
use Stock\Models\Base\Market;
use Stock\Jobs\Scrapers\Company as ScrapeCompanyJob;

class Company extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrape:company {--market=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'To scrape companies of all / a particular market';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @param MarketContract $marketRepo
     * @return mixed
     */
    public function handle(MarketContract $marketRepo)
    {

        if (!is_null($this->option('market'))) {
            $market = $marketRepo->get($this->option('market'));
            $this->processSingleMarket($market);
        } else {
            $markets = $marketRepo->all();
            $markets->each(function (Market $market) {
                $this->processSingleMarket($market);
            });
        }

    }

    protected function processSingleMarket(Market $market)
    {
        dispatch((new ScrapeCompanyJob($market)));
    }
}
