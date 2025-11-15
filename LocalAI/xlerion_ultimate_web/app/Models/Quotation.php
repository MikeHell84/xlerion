<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    use HasFactory;

    protected $fillable = [
    'client_name',
    'client_email',
    'phone',
    'selected_services',
    'service_breakdown',
    'estimated_total',
    'status',
    'notes',
    ];

    protected $casts = [
    'selected_services' => 'array',
    'service_breakdown' => 'array',
    ];
}
