<?php

namespace Modules\Departments\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Departments\Database\Factories\RoomFactory;
use Modules\Users\Models\Patient;

// use Modules\Departments\Database\Factories\RoomFactory;

class Room extends Model
{
    use HasFactory;

    protected $fillable = ['room_number', 'status', 'type', 'department_id'];

    public static function factory()
    {
        return RoomFactory::new();

    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function patients()
    {
        return $this->hasMany(Patient::class);
    }

}
