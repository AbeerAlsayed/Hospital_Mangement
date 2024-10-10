<?php

namespace Modules\Records\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Records\Database\Factories\PatientMovementFactory;

class Patient_Movement extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    // protected static function newFactory(): PatientMovementFactory
    // {
    //     // return PatientMovementFactory::new();
    // }
}
