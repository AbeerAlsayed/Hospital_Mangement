<?php

namespace Modules\Users\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Modules\Users\Database\Factories\UserFactory;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'phone_number',
        'address',
        'date_of_birth',
        'gender',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];


// use Illuminate\Foundation\Auth\User as Authenticatable;
// use Illuminate\Database\Eloquent\Factories\HasFactory;

    /**
     * علاقة One-to-One مع Doctor
     */
    public function doctor()
    {
        return $this->hasOne(Doctor::class);
    }

    /**
     * علاقة One-to-One مع Nurse
     */
    public function nurse()
    {
        return $this->hasOne(Nurse::class);
    }

    /**
     * علاقة One-to-One مع Patient
     */
    public function patient()
    {
        return $this->hasOne(Patient::class);
    }
}
