<?php

namespace App\Providers;

use App\Repositories\Contracts\LimousineBookingRepositoryInterface;
use App\Repositories\Contracts\VehicleBrandRepositoryInterface;
use App\Repositories\Contracts\VehicleRepositoryInterface;
use App\Repositories\DbLimousineBookingRepository;
use App\Repositories\DbVehicleBrandRepository;
use App\Repositories\DbVehicleRepository;
use Illuminate\Support\ServiceProvider;

 class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(VehicleBrandRepositoryInterface::class, DbVehicleBrandRepository::class);
        $this->app->bind(VehicleRepositoryInterface::class, DbVehicleRepository::class);
        $this->app->bind(LimousineBookingRepositoryInterface::class, DbLimousineBookingRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}