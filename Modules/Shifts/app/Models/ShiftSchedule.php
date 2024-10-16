<?php

namespace Modules\Shifts\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Departments\Models\Department;
use Modules\Users\Models\Doctor;
use Modules\Users\Models\Nurse;

// use Modules\Shifts\Database\Factories\ShiftSchedulesFactory;

class ShiftSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'doctor_id',
        'nurse_id',
        'department_id',
        'date',
        'time',
    ];

    // العلاقات
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function nurse()
    {
        return $this->belongsTo(Nurse::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    // protected static function newFactory(): ShiftSchedulesFactory
    // {
    //     // return ShiftSchedulesFactory::new();
    // }
}
