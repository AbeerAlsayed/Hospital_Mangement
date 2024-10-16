<?php

namespace Modules\Users\Services;

use Exception;
use Modules\Users\Models\Patient;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PatientService
{
    public function createPatient(array $data)
    {
        try {
            $patient = Patient::create($data);

            if (isset($data['doctor_ids'])) {
                $patient->doctors()->sync($data['doctor_ids']);
            }

            return $patient;
        } catch (Exception $e) {
            Log::error('Error creating patient: ' . $e->getMessage());
            throw new Exception('Error creating patient.');
        }
    }

    public function getPatient(int $id)
    {
        try {
            return Patient::with(['user', 'room', 'doctors'])->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new Exception('Patient not found.');
        }
    }

    public function updatePatient(array $data, int $id)
    {
        try {
            $patient = Patient::findOrFail($id);
            $patient->update($data);

            if (isset($data['doctor_ids'])) {
                $patient->doctors()->sync($data['doctor_ids']);
            }

            return $patient;
        } catch (ModelNotFoundException $e) {
            throw new Exception('Patient not found.');
        }
    }

    public function deletePatient(int $id)
    {
        try {
            $patient = Patient::findOrFail($id);
            $patient->delete();
        } catch (ModelNotFoundException $e) {
            throw new Exception('Patient not found.');
        }
    }

    public function getAllPatients($perPage = 10)
    {
        return Patient::with(['user', 'room', 'doctors'])->paginate($perPage);
    }
}
