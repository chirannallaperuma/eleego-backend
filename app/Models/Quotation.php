<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    protected $fillable = [
        'quotation_no',
        'quotation_date',
        'client_name',
        'organization',
        'address',
        'start_date',
        'end_date',
        'vehicle_type',
        'rate_per_day',
        'days',
        'total_amount',
        'cancel_before',
        'contact_person',
        'contact_number',
        'terms_and_conditions'
    ];
}
