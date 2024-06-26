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
        'capacity',
        'seats',
        'doors',
        'luggages',
        'availability',
        'category',
        'image'
    ];

    public function brands()
    {
        return $this->hasOne(VehicleBrandModel::class, 'brand_name', 'brand_name');
    }
}
