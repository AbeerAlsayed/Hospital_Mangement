<?php

namespace Modules\Users\Services;

use Modules\Users\Models\User;
use Illuminate\Support\Facades\Hash;
class UserService
{
    public function createUser(array $data)
    {
        $data['password'] = Hash::make($data['password']);

        // يجب أن تُرجع كائن User تم إنشاؤه
        return User::create($data);
    }
}
