<?php

namespace Modules\Records\Services;

use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Modules\Records\Models\PatientMovement;

class PatientMovementService
{
    
    public function registerEntry(int $patientId)
    {
        try {
            return PatientMovement::create([
                'patient_id' => $patientId,
                'entry_time' => now(),
                'exit_time' => null, // Default to null for entry
            ]);
        } catch (Exception $e) {
            Log::error('Error registering patient entry: ' . $e->getMessage());
            throw new Exception('Error registering patient entry.');
        }
    }

    // Register patient exit
    public function registerExit(int $id)
    {
        try {
            $movement = PatientMovement::findOrFail($id);
            $movement->exit_time = now(); // Set exit time
            $movement->save();
            return $movement;
        } catch (Exception $e) {
            Log::error('Error registering patient exit: ' . $e->getMessage());
            throw new Exception('Error registering patient exit.');
        }
    }


    public function getById(int $id)
    {
        try {
            return PatientMovement::with('patient')->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new Exception('Patient movement not found.');
        }
    }

    public function update(array $data, int $id)
    {
        try {
            $movement = PatientMovement::findOrFail($id);
            $movement->update($data);
            return $movement;
        } catch (ModelNotFoundException $e) {
            throw new Exception('Patient movement not found.');
        }
    }

    public function delete(int $id)
    {
        try {
            $movement = PatientMovement::findOrFail($id);
            $movement->delete();
        } catch (ModelNotFoundException $e) {
            throw new Exception('Patient movement not found.');
        }
    }

    public function getAllPaginated($perPage = 10)
    {
        return PatientMovement::with('patient')->paginate($perPage);
    }
}
