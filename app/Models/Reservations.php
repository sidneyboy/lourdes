<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservations extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'number',
        'receipt',
        'status',
        'date_from',
        'date',
    ];

    public function reservation_details()
    {
        return $this->hasMany('App\Models\Reservations_details', 'reservation_id');
    }
}
