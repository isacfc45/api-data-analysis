<?php

namespace App\Providers;

use App\Repositories\SaleRepository;
use App\Repositories\SaleRepositoryInterface;
use App\Repositories\UserRepository;
use App\Repositories\UserRepositoryInterface;
use App\Services\AuthService;
use App\Services\SaleService;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(UserService::class, function ($app) {
            return new UserService($app->make(UserRepositoryInterface::class));
        });
        $this->app->bind(AuthService::class, function ($app) {
            return new AuthService();
        });
        $this->app->bind(SaleRepositoryInterface::class, SaleRepository::class);

        $this->app->bind(SaleService::class, function ($app) {
            return new SaleService($app->make(SaleRepositoryInterface::class));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
