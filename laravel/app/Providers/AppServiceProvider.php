<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repository\Contracts\UserRepositoryInterface;
use App\Repository\Contracts\FeatureFlagInterface;
use App\Repository\Contracts\ProductTypeInterface;
use App\Repository\UserRepository;
use App\Repository\FeatureFlagRepository;
use App\Repository\ProductTypeRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(FeatureFlagInterface::class, FeatureFlagRepository::class);
        $this->app->bind(ProductTypeInterface::class, ProductTypeRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}