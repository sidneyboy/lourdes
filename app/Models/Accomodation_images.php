<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accomodation_images extends Model
{
    use HasFactory;

    protected $fillable = [
        'accomodation_id',
        'image',
    ];
}
