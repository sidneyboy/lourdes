<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservations_details extends Model
{
    use HasFactory;

    protected $fillable = [
        'reservation_id',
        'payment',
        'status',
    ];
}
