<?php

namespace Modules\Users\Services;

use Modules\Users\Models\User;

class UserService
{
    public function createUser(array $data)
    {
        // يجب أن تُرجع كائن User تم إنشاؤه
        return User::create($data);
    }
}
