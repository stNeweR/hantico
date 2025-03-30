<?php

namespace App\Providers;

use App\Repositories\CarBrandModelRepository;
use App\Repositories\CarBrandRepository;
use App\Repositories\Contracts\BaseRepositoryInterface;
use App\Repositories\Contracts\CarBrandModelRepositoryInterface;
use App\Repositories\Contracts\CarBrandRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            CarBrandRepositoryInterface::class,
            CarBrandRepository::class
        );

        $this->app->bind(
            CarBrandModelRepositoryInterface::class,
            CarBrandModelRepository::class
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
