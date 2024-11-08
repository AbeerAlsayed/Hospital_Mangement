<?php

namespace Modules\Users\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Departments\Models\Department;
use Modules\Records\Models\MedicalRecord;
use Modules\Shifts\Models\ShiftSchedule;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'specialization', 'department_id', 'salary',];

    protected $hidden = ['salary'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function patients()
    {
        return $this->belongsToMany(Patient::class, 'doctor_patient')->withTimestamps();
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function shifts()
    {
        return $this->morphMany(ShiftSchedule::class, 'shiftable');
    }
    public function medicalRecords()
    {
        return $this->hasMany(MedicalRecord::class);
    }
}
