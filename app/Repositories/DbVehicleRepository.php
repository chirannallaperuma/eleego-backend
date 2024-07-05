<?php

namespace App\Repositories;

use App\Models\VehicleModel;
use App\Repositories\BaseRepository;
use App\Repositories\Contracts\VehicleRepositoryInterface;

class DbVehicleRepository extends BaseRepository implements VehicleRepositoryInterface
{
    public function __construct(VehicleModel $model)
    {
        $this->model = $model;
    }
    
    /**
     * getVehiclesByType
     *
     * @param  mixed $type
     * @return void
     */
    public function getVehiclesByType($type)
    {
        $type = $type == 'limousine' ? 'Limousine' : 'Rental';

        $vehicles = $this->model->where('category', $type)
            ->where('availability', VehicleRepositoryInterface::VEHICLE_AVAILABLE)
            ->get();

        return $vehicles;
    }
}
