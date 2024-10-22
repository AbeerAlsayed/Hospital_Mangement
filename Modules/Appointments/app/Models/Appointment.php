<?php

namespace Modules\Appointments\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Users\Models\Doctor;
use Modules\Users\Models\Patient;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'appointment_date',
        'patient_id',
        'doctor_id',
        'status',
        'time',
    ];

    // Define relationship with Patient model
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    // Define relationship with Doctor model
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
