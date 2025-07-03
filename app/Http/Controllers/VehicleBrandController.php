<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ApiHelper;
use App\Repositories\Contracts\VehicleBrandRepositoryInterface;
use Illuminate\Http\Request;

class VehicleBrandController extends Controller
{
    use ApiHelper;

    protected $vehicleBrandRepository;

    public function __construct(VehicleBrandRepositoryInterface $vehicleBrandRepository)
    {
        $this->vehicleBrandRepository = $vehicleBrandRepository;
    }
    
    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        $this->vehicleBrandRepository->create($request->all());
    }
    
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $brands = $this->vehicleBrandRepository->getAllBrands();

        return $brands;
    }
}
