<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'license_plate',
        'brand',
        'model',
        'type',
        'date_of_registration',
        'vin',
        'color',
        'mileage',
        'energy',
        'date_of_purchase',
        'number_of_owner',
        'images',
        'attachments',
    ];
    
}
