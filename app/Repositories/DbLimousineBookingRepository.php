<?php

namespace App\Repositories;

use App\Models\LimousineBookingModel;
use App\Repositories\Contracts\LimousineBookingRepositoryInterface;
use Illuminate\Support\Facades\Mail;

class DbLimousineBookingRepository extends BaseRepository implements LimousineBookingRepositoryInterface
{
    public function __construct(LimousineBookingModel $model)
    {
        $this->model = $model;
    }
    
    /**
     * sendBookingConfirmMail
     *
     * @param  mixed $quotation
     * @return void
     */
    public function sendBookingConfirmMail($quotation)
    {
        $emailData = [
            'title' => 'Limousine Booking',
            'body' => 'We are pleased to inform you that a new limousine booking has been received. Below are the details of the booking:',
            'quotation' => $quotation,
            'email' => 'info@eleego.ch'
        ];

        Mail::send('emails.limousine-booking', $emailData, function ($message) use ($quotation, $emailData) {
            $message->to('info@eleego.ch')
                ->subject('Account' . ' ' . $emailData['title'])
                ->from($quotation->customer_email);
        });
    }
    
    /**
     * getAllBookings
     *
     * @return void
     */
    public function getAllBookings()
    {
        $bookings = $this->model->orderBy('created_at', 'desc')->paginate(10);

        return $bookings;
    }
}
