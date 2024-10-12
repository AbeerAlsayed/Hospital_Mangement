<?php

// namespace Modules\Users\Models;

// use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\Factories\HasFactory;
// // use Modules\Users\Database\Factories\NurseFactory;

// class Nurse extends Model
// {
//     use HasFactory;

//     /**
//      * The attributes that are mass assignable.
//      */
//     protected $fillable = [];

//     // protected static function newFactory(): NurseFactory
//     // {
//     //     // return NurseFactory::new();
//     // }
// }


namespace Modules\Users\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Nurse extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'department_id',
        'shift',
    ];

    /**
     * علاقة One-to-One مع User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * علاقة One-to-Many مع Department
     */
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
