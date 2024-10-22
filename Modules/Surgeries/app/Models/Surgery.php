<?php

namespace Modules\Surgeries\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Departments\Models\Room;
use Modules\Users\Models\Doctor;
use Modules\Users\Models\Patient;

class Surgery extends Model
{
    protected $fillable = [
        'patient_id', 'doctor_id','room_id', 'type_surgery', 'date_scheduled', 'status_surgery',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
    public function room(){
        return $this->belongsTo(Room::class);
    }
}
