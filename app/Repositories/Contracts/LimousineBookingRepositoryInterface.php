<?php

namespace App\Repositories\Contracts;

interface LimousineBookingRepositoryInterface
{
    public function sendBookingConfirmMail($quotation);

    public function getAllBookings();
}