<?php

// namespace Modules\Records\Models;

// use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\Factories\HasFactory;
// // use Modules\Records\Database\Factories\PatientMovementFactory;

// class PatientMovement extends Model
// {
//     use HasFactory;

//     /**
//      * The attributes that are mass assignable.
//      */
//     protected $fillable = [];

//     // protected static function newFactory(): PatientMovementFactory
//     // {
//     //     // return PatientMovementFactory::new();
//     // }
// }




namespace Modules\Records\Models;

use Illuminate\Database\Eloquent\Model;

class PatientMovement extends Model
{
    protected $fillable = [
        'patient_id',
        'entry_time',
        'exit_time',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
