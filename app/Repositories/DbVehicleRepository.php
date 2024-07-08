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
    
    /**
     * checkAvailability
     *
     * @param  mixed $data
     * @return void
     */
    public function checkAvailability($data)
    {
        $vehicle = $this->model->find($data['vehicle_id']);

        $startDate = $data['start_date'];
        $endDate = $data['end_date'];

        return !$vehicle->limousineBookings()
            ->where(function ($query) use ($startDate, $endDate) {
                $query->whereBetween('pickup_date_time', [$startDate, $endDate])
                    ->orWhereBetween('drop_date_time', [$startDate, $endDate])
                    ->orWhere(function ($query) use ($startDate, $endDate) {
                        $query->where('pickup_date_time', '<', $startDate)
                            ->where('drop_date_time', '>', $endDate);
                    });
            })->exists();
    }
}
