<?php

namespace Stock\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\Stock\Contracts\Models\Base\MarketContract::class, \Stock\Repositories\Models\Base\MarketRepository::class);
        $this->app->bind(\Stock\Contracts\Models\Base\CompanyContract::class, \Stock\Repositories\Models\Base\CompanyRepository::class);
    }
}
