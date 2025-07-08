<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'invoice_no',
        'invoice_date',
        'due_date',
        'client_name',
        'client_address',
        'reference',
        'total',
        'items',
        'extras'
    ];

    protected $casts = [
        'items' => 'array',
        'extras' => 'array',
    ];
}
