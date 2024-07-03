<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ApiHelper;
use App\Repositories\Contracts\LimousineBookingRepositoryInterface;
use App\Repositories\Contracts\VehicleRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Throwable;

class LimousineBookingController extends Controller
{
    use ApiHelper;

    protected $limousineBookingRepository;

    protected $vehicleRepository;

    public function __construct(
        LimousineBookingRepositoryInterface $limousineBookingRepository,
        VehicleRepositoryInterface $vehicleRepository
    ) {
        $this->limousineBookingRepository = $limousineBookingRepository;
        $this->vehicleRepository = $vehicleRepository;
    }

    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $bookings = $this->limousineBookingRepository->getAllBookings(['vehicle']);

        return view('admin.limousine-bookings.bookings', ['bookings' => $bookings]);
    }
    
    /**
     * confirmBooking
     *
     * @param  mixed $request
     * @return void
     */
    public function confirmBooking(Request $request)
    {
        try {
            $vehicle = $this->vehicleRepository->find($request->vehicle_id);

            if (!$vehicle) {
                return $this->apiError("selected vehicle not found", Response::HTTP_NOT_FOUND);
            }

            if ($vehicle->availability == VehicleRepositoryInterface::VEHICLE_BOOKED) {
                return $this->apiError("selected vehicle not available for booking", Response::HTTP_BAD_REQUEST);
            }

            $quotation = $this->limousineBookingRepository->create($request->all());

            if ($quotation) {
                $this->limousineBookingRepository->sendBookingConfirmMail($quotation);

                $vehicle->update([
                    'availability' => VehicleRepositoryInterface::VEHICLE_BOOKED
                ]);
            }

            Log::info("LimousineBookingController (confirmBooking) : booking confirmed : email - {$request->customer_email}");

            return $this->apiSuccess($quotation);
        } catch (Throwable $th) {
            Log::error("LimousineBookingController (confirmBooking) : error creating quotation' , email - {$request->customer_email}  | Reason - {$th->getMessage()}" . PHP_EOL . $th->getTraceAsString());

            return $this->apiError("something went wrong");
        }
    }
}
