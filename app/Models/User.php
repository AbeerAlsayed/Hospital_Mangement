<?php

namespace App\Models;

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


}
