<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\LimousineBookingRepositoryInterface;
use Illuminate\Http\Request;

class LimousineBookingController extends Controller
{
    protected $limousineBookingRepository;

    public function __construct(LimousineBookingRepositoryInterface $limousineBookingRepository)
    {
        $this->limousineBookingRepository = $limousineBookingRepository;
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
}
