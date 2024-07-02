<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ApiHelper;
use App\Repositories\Contracts\LimousineBookingRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;

class LimousineBookingController extends Controller
{
    use ApiHelper;

    protected $limousineBookingRepository;

    public function __construct(LimousineBookingRepositoryInterface $limousineBookingRepository)
    {
        $this->limousineBookingRepository = $limousineBookingRepository;
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
            $quotation = $this->limousineBookingRepository->create($request->all());
 
            if ($quotation) {
                $this->limousineBookingRepository->sendBookingConfirmMail($quotation);
            }

            Log::info("LimousineBookingController (confirmBooking) : booking confirmed : email - {$request->customer_email}");

            return $this->apiSuccess($quotation);
        } catch (Throwable $th) {
            Log::error("LimousineBookingController (confirmBooking) : error creating quotation' , email - {$request->customer_email}  | Reason - {$th->getMessage()}" . PHP_EOL . $th->getTraceAsString());

            return $this->apiError("something went wrong");
        }
    }
}