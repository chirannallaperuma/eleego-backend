<?php

namespace App\Repositories\Contracts;

interface VehicleRepositoryInterface 
{
    const VEHICLE_BOOKED = "Booked";
    const VEHICLE_AVAILABLE = "Available";

    public function getVehiclesByType($type);

    public function checkAvailability($data);
}
