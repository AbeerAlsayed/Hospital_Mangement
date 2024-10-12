<?php

// namespace Modules\Users\Models;

// use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\Factories\HasFactory;
// // use Modules\Users\Database\Factories\PatientFactory;

// class Patient extends Model
// {
//     use HasFactory;

//     /**
//      * The attributes that are mass assignable.
//      */
//     protected $fillable = [];

//     // protected static function newFactory(): PatientFactory
//     // {
//     //     // return PatientFactory::new();
//     // }
// }


namespace Modules\Users\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'doctor_id',
        'room_id',
    ];

    /**
     * علاقة One-to-One مع User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * علاقة One-to-Many مع Doctor
     */
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    /**
     * علاقة One-to-Many مع Room
     */
    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
