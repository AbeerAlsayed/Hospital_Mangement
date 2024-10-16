<?php

// namespace Modules\Users\Models;

// use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Foundation\Auth\User as Authenticatable;
// use Modules\Users\Database\Factories\UserFactory;

// class User extends \App\Models\User
// {
//     protected static function newFactory()
//     {
//         return UserFactory::new();
//     }
// }


namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

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

    protected $casts = [
        'email_verified_at' => 'datetime',
        'date_of_birth' => 'date',
    ];

    // علاقة واحد إلى واحد مع Doctor
    public function doctor()
    {
        return $this->hasOne(Doctor::class);
    }

    // علاقة واحد إلى واحد مع Patient
    public function patient()
    {
        return $this->hasOne(Patient::class);
    }
}
