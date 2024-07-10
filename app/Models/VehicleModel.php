<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VehicleModel extends Model
{
    protected $table = 'tbdb_vehicles';

    protected $fillable = [
        'brand_name',
        'name',
        'transmission',
        'fuel_type',
        'per_day_amount',
        'seats',
        'doors',
        'baggages',
        'availability',
        'category',
        'image_path',
        'image_url',
        'image_disk',
        'last_booking_pickup_date',
        'last_booking_drop_date',
        'description'
    ];

    protected $dates = ['deleted_at'];

    protected $casts = [
        'last_booking_pickup_date' => 'datetime',
        'last_booking_drop_date' => 'datetime'
    ];

    public function brands()
    {
        return $this->hasOne(VehicleBrandModel::class, 'brand_name', 'brand_name');
    }

    public function limousineBookings()
    {
        return $this->hasMany(LimousineBookingModel::class, 'id', 'vehicle_id');
    }
}
