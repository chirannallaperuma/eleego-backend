<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ApiHelper;
use App\Repositories\Contracts\VehicleBrandRepositoryInterface;
use App\Repositories\Contracts\VehicleRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Throwable;

class VehicleController extends Controller
{
    use ApiHelper;

    protected $vehicleRepository;

    protected $vehicleBrandRepository;

    public function __construct(
        VehicleRepositoryInterface $vehicleRepository,
        VehicleBrandRepositoryInterface $vehicleBrandRepository
    ) {
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

            $diskName = 'public';
            $disk = Storage::disk($diskName);

            $path = $request->file('image')->store('uploads/vehicles/' . $fileName, $diskName);
            $url = $disk->url($path);

            $vehicle->update([
                'image_path' => $path,
                'image_url' => $url,
                'image_disk' => $diskName,
            ]);
        }

        return redirect()->back()->with('alert', 'Vehicle updated successfully!');
    }

    /**
     * getVehiclesByType
     *
     * @param  mixed $type
     * @return void
     */
    public function getVehiclesByType($type)
    {
        try {
            $vehicles = $this->vehicleRepository->getVehiclesByType($type);

            return $this->apiSuccess($vehicles);
        } catch (Throwable $th) {
            Log::error("VehicleController (getVehiclesByType) : error fetching vehicles' | Reason - {$th->getMessage()}" . PHP_EOL . $th->getTraceAsString());

            return $this->apiError("something went wrong");
        }
    }
}
