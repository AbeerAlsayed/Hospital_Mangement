<?php

namespace Modules\Users\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Departments\Models\Department;
use Modules\Shifts\Models\ShiftSchedule;

class Nurse extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'department_id',
    ];

    // العلاقة مع المستخدم
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // العلاقة مع القسم
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function shifts()
    {
        return $this->morphMany(ShiftSchedule::class, 'shiftable');
    }
}
