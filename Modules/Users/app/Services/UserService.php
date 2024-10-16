<?php

namespace Modules\Users\Services;

use Exception;
use Modules\Users\Models\User;
use Modules\Users\Models\Doctor;
use Modules\Users\Models\Patient;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserService
{
    public function createUser(array $data)
    {
        try {
            // تشفير كلمة المرور
            $data['password'] = Hash::make($data['password']);
            
            // إنشاء المستخدم
            $user = User::create($data);

            // إذا كان المستخدم Doctor، إنشاء سجل الطبيب وربط المرضى
            if ($data['role'] === 'doctor') {
                $doctor = $user->doctor()->create([
                    'specialization' => $data['specialization'],
                    'department_id' => $data['department_id'],
                    'salary' => $data['salary'],
                ]);

                // ربط المرضى بالأطباء
                if (isset($data['patient_ids'])) {
                    $doctor->patients()->sync($data['patient_ids']);
                }
            }

            // إذا كان المستخدم Patient، إنشاء سجل المريض وربط الطبيب والغرفة
            if ($data['role'] === 'patient') {
                $user->patient()->create([
                    'doctor_id' => $data['doctor_id'],
                    'room_id' => $data['room_id'],
                ]);
            }

            return $user;
        } catch (Exception $e) {
            Log::error('Error creating user: ' . $e->getMessage());
            // throw new Exception('Error creating user.');
            return $e->getMessage();
        }
    }

    public function getUser(int $id)
    {
        try {
            return User::with(['doctor.patients', 'patient.doctor', 'patient.room'])->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new Exception('User not found.');
        }
    }

    public function updateUser(array $data, int $id)
    {
        try {
            $user = User::findOrFail($id);

            // تحديث كلمة المرور إذا كانت موجودة
            if (isset($data['password'])) {
                $data['password'] = Hash::make($data['password']);
            }

            // تحديث بيانات المستخدم
            $user->update($data);

            // تحديث البيانات الخاصة بالطبيب إذا كان المستخدم Doctor
            if ($user->role === 'doctor') {
                $user->doctor()->update([
                    'specialization' => $data['specialization'],
                    'department_id' => $data['department_id'],
                    'salary' => $data['salary'],
                ]);

                // تحديث العلاقات مع المرضى
                if (isset($data['patient_ids'])) {
                    $user->doctor->patients()->sync($data['patient_ids']);
                }
            }

            // تحديث البيانات الخاصة بالمريض إذا كان المستخدم Patient
            if ($user->role === 'patient') {
                $user->patient()->update([
                    'doctor_id' => $data['doctor_id'],
                    'room_id' => $data['room_id'],
                ]);
            }

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

    public function getAllUsers($perPage = 10)
    {
        return User::with(['doctor.patients', 'patient.doctor', 'patient.room'])->paginate($perPage);
    }
}
