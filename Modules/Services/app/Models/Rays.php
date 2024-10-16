<?php

namespace Modules\Services\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Users\Models\Doctor;
use Modules\Users\Models\Patient;

// use Modules\Services\Database\Factories\RaysFactory;

class Rays extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'doctor_id',
        'radiology_type',
        'imaging_date',
        'results',
        'status',
    ];

    // العلاقات
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

//     protected static function newFactory(): RaysFactory
//     {
//         // return RaysFactory::new();
//     }
}
