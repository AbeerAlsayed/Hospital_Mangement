<?php

namespace Modules\Users\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'room_id',
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
}
