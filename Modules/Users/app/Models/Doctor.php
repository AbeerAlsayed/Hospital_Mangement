<?php

namespace Modules\Users\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Departments\Models\Department;
use Modules\Shifts\Models\ShiftSchedule;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'specialization', 'department_id', 'salary',];

    // علاقة مع المستخدم
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // علاقة مع المرضى (many-to-many)
    public function patients()
    {
        return $this->belongsToMany(Patient::class, 'doctor_patient')->withTimestamps();
    }

    // علاقة مع القسم
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function shifts()
    {
        return $this->morphMany(ShiftSchedule::class, 'shiftable');
    }

}
