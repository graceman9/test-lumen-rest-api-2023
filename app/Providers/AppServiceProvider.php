<?php

namespace App\Providers;

use App\Contracts\Service\MailServiceInterface;
use App\Services\MailService;
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
            \App\Contracts\Repository\CompanyRepositoryInterface::class,
            \App\Repositories\CompanyRepository::class
        );
        $this->app->bind(
            \App\Contracts\Service\CompanyServiceInterface::class,
            \App\Services\CompanyService::class
        );

        $this->app->bind(
            \App\Contracts\Repository\UserRepositoryInterface::class,
            \App\Repositories\UserRepository::class
        );
        $this->app->bind(
            \App\Contracts\Service\UserServiceInterface::class,
            \App\Services\UserService::class,
        );

        $this->app->bind(
            \App\Contracts\Repository\VerificationTokenRepositoryInterface::class,
            \App\Repositories\VerificationTokenRepository::class
        );
        $this->app->bind(
            \App\Contracts\Service\VerificationTokenServiceInterface::class,
            \App\Services\VerificationTokenService::class,
        );

        $this->app->bind(
            \App\Contracts\Service\AuthServiceInterface::class,
            \App\Services\AuthService::class,
        );

        $this->app->bind(
            \App\Contracts\Service\MailServiceInterface::class,
            \App\Services\MailService::class,
        );
    }
}
