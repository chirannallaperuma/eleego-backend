<?php
 
namespace App\Repositories;

use App\Models\VehicleBrandModel;
use App\Repositories\BaseRepository;
use App\Repositories\Contracts\VehicleBrandRepositoryInterface;

class DbVehicleBrandRepository extends BaseRepository implements VehicleBrandRepositoryInterface
{
    public function __construct(VehicleBrandModel $model)
    {
        $this->model = $model;
    }

    public function getAllBrands()
    {
        $brands = $this->model->all();

        return $brands;
    }
}