<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LimousineBookingModel extends Model
{
    protected $table = 'tbdb_limousine_bookings';

    protected $fillable = [
        'vehicle_id',
        'pickup_date_time',
        'drop_date_time',
        'service_type',
        'pickup_address',
        'drop_address',
        'no_of_persons',
        'customer_name',
        'customer_email',
        'customer_phone',
        'payment_method',
        'additional_services',
        'additional_information',
        'status',
        'total_amount',
    ];

    protected $casts = [
        'pickup_date_time' => 'datetime',
        'drop_date_time' => 'datetime',
        'additional_services' => 'array',
    ];

    protected $attributes = [
        'status' => 'pending'
    ];

    public function vehicle()
    {
        return $this->hasOne(VehicleModel::class, 'id', 'vehicle_id');
    }
}
