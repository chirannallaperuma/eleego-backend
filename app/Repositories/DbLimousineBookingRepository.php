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
            'email' => config('mail.to')
        ];

        Mail::send('emails.limousine-booking', $emailData, function ($message) use ($emailData) {
            $message->to(config('mail.to'))
                ->subject('Account' . ' ' . $emailData['title'])
                ->from(config('mail.from.address'));
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
