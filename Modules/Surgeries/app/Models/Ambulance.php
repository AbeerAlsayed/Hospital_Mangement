<?php

namespace Modules\Surgeries\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Surgeries\Database\Factories\AmbulanceFactory;

class Ambulance extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    // protected static function newFactory(): AmbulanceFactory
    // {
    //     // return AmbulanceFactory::new();
    // }
}