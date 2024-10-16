<?php

// namespace Modules\Surgeries\Models;

// use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\Factories\HasFactory;
// // use Modules\Surgeries\Database\Factories\SurgeryFactory;

// class Surgery extends Model
// {
//     use HasFactory;

//     /**
//      * The attributes that are mass assignable.
//      */
//     protected $fillable = [];

//     // protected static function newFactory(): SurgeryFactory
//     // {
//     //     // return SurgeryFactory::new();
//     // }
// }

namespace Modules\Surgeries\Models;

use Illuminate\Database\Eloquent\Model;

class Surgery extends Model
{
    protected $fillable = [
        'patient_id', 'doctor_id', 'type_surgery', 'date_scheduled', 'status_surgery',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
