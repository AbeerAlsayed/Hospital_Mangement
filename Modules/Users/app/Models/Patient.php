<?php

namespace Modules\Users\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Departments\Models\Room;
use Modules\Records\Models\MedicalRecord;
use Modules\Services\Models\Laboratory;
use Modules\Services\Models\Rays;
use Modules\Surgeries\Models\Surgery;

class Patient extends Model
{
    protected $fillable = [
        'user_id',
        'room_id',
        'national_number',
    ];

    // علاقة مع المستخدم
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // علاقة مع الأطباء (many-to-many)
    public function doctors()
    {
        return $this->belongsToMany(Doctor::class, 'doctor_patient')->withTimestamps();
    }

    // علاقة مع الغرفة
    public function room()
    {
        return $this->belongsTo(Room::class);
    }
    public function medicalRecord()
    {
        return $this->hasOne(MedicalRecord::class);
    }
    public function rays()
    {
        return $this->hasMany(Rays::class);
    }

    public function laboratories()
    {
        return $this->hasMany(Laboratory::class);
    }
    public function surgeries()
    {
        return $this->hasMany(Surgery::class);
    }
}
