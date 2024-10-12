<?php

namespace Modules\Users\Services;

use Modules\Users\Entities\User;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;

class UserService
{
    public function createUser(array $data)
    {
        try {
            return User::create($data);
        } catch (Exception $e) {
            Log::error('Error creating user: ' . $e->getMessage());
            throw new Exception('Error creating user.');
        }
    }

    public function getUser(int $id)
    {
        try {
            return User::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new Exception('User not found.');
        }
    }

    public function updateUser(array $data, int $id)
    {
        try {
            $user = User::findOrFail($id);
            $user->update(array_filter($data));
            return $user;
        } catch (ModelNotFoundException $e) {
            throw new Exception('User not found.');
        }
    }

    public function deleteUser(int $id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
        } catch (ModelNotFoundException $e) {
            throw new Exception('User not found.');
        }
    }

    // وظيفة جديدة لجلب جميع المستخدمين
    public function getAllUsers()
    {
        return User::all(); // جلب جميع المستخدمين من قاعدة البيانات
    }
}
