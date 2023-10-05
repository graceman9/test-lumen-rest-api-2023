<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            \App\Contracts\CompanyRepositoryInterface::class,
            \App\Repositories\CompanyRepository::class
        );
        $this->app->bind(
            \App\Contracts\CompanyServiceInterface::class,
            \App\Services\CompanyService::class
        );
    }
}
