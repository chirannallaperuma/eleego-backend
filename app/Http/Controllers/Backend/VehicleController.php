<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\VehicleBrandRepositoryInterface;
use App\Repositories\Contracts\VehicleRepositoryInterface;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    protected $vehicleRepository;

    protected $vehicleBrandRepository;

    public function __construct(
        VehicleRepositoryInterface $vehicleRepository,
        VehicleBrandRepositoryInterface $vehicleBrandRepository
        )
    {
        $this->vehicleRepository = $vehicleRepository;
        $this->vehicleBrandRepository = $vehicleBrandRepository;
    }

    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $vehicles = $this->vehicleRepository->findAll();

        $brands = $this->vehicleBrandRepository->findAll();

        return view('admin.vehicles.vehicle-list', ['vehicles' => $vehicles, 'brands' => $brands]);
    }

    /**
     * create
     *
     * @return void
     */
    public function create()
    {
        return view('admin.vehicles.add-vehicle');
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        $data = $request->except('image');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileExtension = $image->getClientOriginalExtension();
            $fileName = $request->name . '.' . $fileExtension;

            $data['image'] = $fileName;

            $imagePath = 'uploads/vehicles';
            $image->move($imagePath, $fileName);
        }

        $this->vehicleRepository->create($data);

        return redirect()->back()->with('alert', 'Vehicle created successfully!');
    }
    
    /**
     * update
     *
     * @param  mixed $request
     * @return void
     */
    public function update(Request $request)
    {
        $data = $request->all();
    
        $vehicle = $this->vehicleRepository->find($request->id);

        $vehicle->update($data);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileExtension = $image->getClientOriginalExtension();
            $fileName = $request->name . '.' . $fileExtension;

            $imagePath = 'uploads/vehicles';
            $image->move($imagePath, $fileName);

            $vehicle->update([
                'image' => $fileName
            ]);
        }

        return redirect()->back()->with('alert', 'Vehicle updated successfully!');
    }
}
