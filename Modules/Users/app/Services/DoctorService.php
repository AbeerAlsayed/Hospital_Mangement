<?php

namespace Modules\Users\Services;

use Exception;
use Modules\Users\Models\Doctor;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DoctorService
{
    public function createDoctor(array $data)
    {
        try {
            $doctor = Doctor::create($data);

            if (isset($data['patient_ids'])) {
                $doctor->patients()->sync($data['patient_ids']);
            }

            return $doctor;
        } catch (Exception $e) {
            Log::error('Error creating doctor: ' . $e->getMessage());
            throw new Exception('Error creating doctor.');
        }
    }

    public function getDoctor(int $id)
    {
        try {
            return Doctor::with(['user', 'department', 'patients'])->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new Exception('Doctor not found.');
        }
    }

    public function updateDoctor(array $data, int $id)
    {
        try {
            $doctor = Doctor::findOrFail($id);
            $doctor->update($data);

            if (isset($data['patient_ids'])) {
                $doctor->patients()->sync($data['patient_ids']);
            }

            return $doctor;
        } catch (ModelNotFoundException $e) {
            throw new Exception('Doctor not found.');
        }
    }

    public function deleteDoctor(int $id)
    {
        try {
            $doctor = Doctor::findOrFail($id);
            $doctor->delete();
        } catch (ModelNotFoundException $e) {
            throw new Exception('Doctor not found.');
        }
    }

    public function getAllDoctors($perPage = 10)
    {
        return Doctor::with(['user', 'department', 'patients'])->paginate($perPage);
    }
}
