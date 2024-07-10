<?php

namespace App\Repositories;

use App\Models\BookingModel;
use App\Repositories\Contracts\BookingRepositoryInterface;
use Illuminate\Support\Facades\Mail;

class DbBookingRepository extends BaseRepository implements BookingRepositoryInterface
{
    public function __construct(BookingModel $model)
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
            'title' => 'Booking Request Received',
            'body' => 'We are pleased to inform you that a new limousine booking has been received. Below are the details of the booking:',
            'quotation' => $quotation,
            'email' => config('mail.to')
        ];

        Mail::send('emails.limousine-booking', $emailData, function ($message) use ($emailData) {
            $message->to(config('mail.to'))
                ->subject($emailData['title'])
                ->from(config('mail.from.address'));
        });
    }
    
    /**
     * getAllBookingsByCategory
     *
     * @return void
     */
    public function getAllBookingsByCategory($category)
    {
        $bookings = $this->model->where('category', $category)->orderBy('created_at', 'desc')->paginate(10);

        return $bookings;
    }
}
