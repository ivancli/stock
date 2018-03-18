<?php

namespace Stock\Jobs\Models\Base\Company;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Stock\Contracts\Models\Base\CompanyContract;
use Stock\Models\Base\Market;

class UpdateOrStore implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var array
     */
    protected $data;

    /**
     * @var Market
     */
    protected $market;

    /**
     * Create a new job instance.
     *
     * @param array $data
     * @param Market $market
     */
    public function __construct(array $data, Market $market)
    {
        $this->data = $data;

        $this->market = $market;
    }

    /**
     * Execute the job.
     *
     * @param CompanyContract $companyRepo
     * @return void
     */
    public function handle(CompanyContract $companyRepo)
    {
        \DB::transaction(function () use ($companyRepo) {
            $company = $companyRepo->updateOrStore([
                'symbol' => array_get($this->data, 'symbol'),
                'market_id' => $this->market->getKey(),
            ], $this->data);

            $this->market->companies()->save($company);
        });
    }
}
