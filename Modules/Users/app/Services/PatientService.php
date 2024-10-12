<?php

namespace Modules\Users\Services;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Modules\Users\Models\Patient;

class PatientService
{
    public function createPatient(array $data)
    {
        try {
            return Patient::create($data);
        } catch (Exception $e) {
            throw new Exception('Error creating patient.');
        }
    }

    public function getPatient(int $id)
    {
        try {
            return Patient::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new Exception('Patient not found.');
        }
    }

    public function getAllPatients()
    {
        return Patient::all();
    }

    public function updatePatient(array $data, int $id)
    {
        try {
            $patient = Patient::findOrFail($id);
            $patient->update(array_filter($data));
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
}
