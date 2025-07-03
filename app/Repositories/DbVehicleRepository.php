<?php

namespace App\Repositories;

use App\Models\VehicleModel;
use App\Repositories\BaseRepository;
use App\Repositories\Contracts\VehicleRepositoryInterface;
use Carbon\Carbon;

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
        $startDate = Carbon::parse($data['start_date']);
        $endDate = Carbon::parse($data['end_date']);

        $overlappingBooking = $this->model
            ->where('id', $data['vehicle_id'])
            ->where(function ($query) use ($startDate, $endDate) {
                $query->whereBetween('last_booking_pickup_date', [$startDate, $endDate])
                    ->orWhereBetween('last_booking_drop_date', [$startDate, $endDate])
                    ->orWhere(function ($query) use ($startDate, $endDate) {
                        $query->where('last_booking_pickup_date', '<=', $startDate)
                            ->where('last_booking_drop_date', '>=', $endDate);
                    });
            })
            ->exists();

        if ($overlappingBooking) {
            return false;
        }

        return true;
    }
}
