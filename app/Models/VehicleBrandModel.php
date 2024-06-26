<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VehicleBrandModel extends Model
{
    protected $table = 'tbdb_vehicle_brands';

    protected $fillable = ['brand_name'];
}
