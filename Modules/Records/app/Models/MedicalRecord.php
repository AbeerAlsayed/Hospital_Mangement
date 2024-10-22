<?php

// namespace Modules\Records\Models;

// use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\Factories\HasFactory;
// // use Modules\Records\Database\Factories\MedicalRecordFactory;

// class MedicalRecord extends Model
// {
//     use HasFactory;

//     /**
//      * The attributes that are mass assignable.
//      */
//     protected $fillable = [];

//     // protected static function newFactory(): MedicalRecordFactory
//     // {
//     //     // return MedicalRecordFactory::new();
//     // }
// }


namespace Modules\Records\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Users\Models\Doctor;
use Modules\Users\Models\Patient;

class MedicalRecord extends Model
{
    protected $fillable = [
        'patient_id',
        'doctor_id',
        'date',
        'diagnosis',
        'prescription',
        'treatment_plan',
        'notes',
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
