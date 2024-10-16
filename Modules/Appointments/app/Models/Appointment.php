<?php

namespace Modules\Appointments\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Appointments\Database\Factories\AppointmentFactory;

class Appointment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    // protected static function newFactory(): AppointmentFactory
    // {
    //     // return AppointmentFactory::new();
    // }
}

namespace Modules\Appointments\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
