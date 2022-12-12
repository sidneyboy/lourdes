<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accomodation extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_id',
        'title',
        'description',
        'status',
        'image',
    ];

    public function type()
    {
        return $this->belongsTo('App\Models\Type', 'type_id');
    }

    public function accomodation_image()
    {
        return $this->hasMany('App\Models\Accomodation_images', 'accomodation_id');
    }
}
