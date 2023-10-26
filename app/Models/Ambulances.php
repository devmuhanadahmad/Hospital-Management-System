<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ambulances extends Model
{
    use HasFactory;

    protected $fillable = [
        'car_number',
        'car_model',
        'car_year_made',
        'status',
    ];
}
