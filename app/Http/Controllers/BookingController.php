<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ApiHelper;
use App\Repositories\Contracts\BookingRepositoryInterface;
use App\Repositories\Contracts\VehicleRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Throwable;

class BookingController extends Controller
{
    use ApiHelper;

    protected $bookingRepository;

    protected $vehicleRepository;

    public function __construct(
        BookingRepositoryInterface $bookingRepository,
        VehicleRepositoryInterface $vehicleRepository
    ) {
        $this->bookingRepository = $bookingRepository;
        $this->vehicleRepository = $vehicleRepository;
    }

    /**
     * index
     *
     * @return void
     */
    public function index($category)
    {
        $bookings = $this->bookingRepository->getAllBookingsByCategory($category);

        if ($category == 'limousine') {
            return view('admin.bookings.limousine-bookings', ['bookings' => $bookings]);
        } else {
            return view('admin.bookings.rental-bookings', ['bookings' => $bookings]);
        }
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

            $quotation = $this->bookingRepository->create($request->all());

            if ($quotation) {
                $this->bookingRepository->sendBookingConfirmMail($quotation);

                $vehicle->update([
                    'availability' => VehicleRepositoryInterface::VEHICLE_BOOKED,
                    'last_booking_pickup_date' => $request->pickup_date_time,
                    'last_booking_drop_date' => $request->drop_date_time
                ]);
            }

            Log::info("BookingController (confirmBooking) : booking confirmed : email - {$request->customer_email}");

            return $this->apiSuccess($quotation);
        } catch (Throwable $th) {
            Log::error("BookingController (confirmBooking) : error creating quotation' , email - {$request->customer_email}  | Reason - {$th->getMessage()}" . PHP_EOL . $th->getTraceAsString());

            return $this->apiError("something went wrong");
        }
    }
}
