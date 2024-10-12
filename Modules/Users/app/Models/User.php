<?php

namespace Modules\Users\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Modules\Users\Database\Factories\UserFactory;

class User extends \App\Models\User
{
    protected static function newFactory()
    {
        return UserFactory::new();
    }
}
