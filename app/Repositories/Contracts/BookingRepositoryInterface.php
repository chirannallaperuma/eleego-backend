<?php

namespace App\Repositories\Contracts;

interface BookingRepositoryInterface
{
    public function sendBookingConfirmMail($quotation);

    public function getAllBookingsByCategory($category);
}