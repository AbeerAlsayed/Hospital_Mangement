<?php

namespace Modules\Departments\Models;


namespace Modules\Departments\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Departments\Database\Factories\DepartmentFactory;
use Modules\Shifts\Models\ShiftSchedules;
use Modules\Users\Models\Doctor;
use Modules\Users\Models\Nurse;

class Department extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'head_doctor_id'];

    public function doctors()
    {
        return $this->hasMany(Doctor::class);
    }

    public function nurses()
    {
        return $this->hasMany(Nurse::class);
    }

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function shiftSchedules()
    {
        return $this->hasMany(ShiftSchedules::class);
    }
    protected static function newFactory()
    {
        return DepartmentFactory::new();
    }
}

