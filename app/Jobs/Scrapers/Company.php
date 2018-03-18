<?php

namespace Stock\Jobs\Scrapers;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Stock\Contracts\Scrapers\CompanyContract;
use Stock\Jobs\Models\Base\Company\UpdateOrStore as UpdateOrStoreCompany;
use Stock\Models\Base\Market;

class Company implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var Market
     */
    protected $market;

    /**
     * Create a new job instance.
     *
     * @param Market $market
     */
    public function __construct(Market $market)
    {
        $this->market = $market;

        if (class_exists('Stock\Repositories\Scrapers\Markets\\' . $this->market->symbol)) {
            app()->singleton(CompanyContract::class, function () {
                return app()->make('Stock\Repositories\Scrapers\Markets\\' . $this->market->symbol, [
                    'url' => $this->market->resource_url,
                    'type' => $this->market->type
                ]);
            });
        } else {
            throw new \RuntimeException('class ' . 'Stock\Repositories\Scrapers\Markets\\' . $this->market->symbol . ' does not exist.', 500);
        }
    }

    /**
     * Execute the job.
     *
     * @param CompanyContract $marketRepo
     * @return void
     */
    public function handle(CompanyContract $marketRepo)
    {
        $companies = $marketRepo->fetch()->extract()->getCompanies();

        foreach ($companies as $company) {
            dispatch((new UpdateOrStoreCompany($company, $this->market)));
        }
    }
}
