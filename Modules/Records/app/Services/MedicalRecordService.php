<?php

namespace Modules\Records\Services;

use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Modules\Records\Models\MedicalRecord;

class MedicalRecordService
{
    public function create(array $data)
    {
        try {
            return MedicalRecord::create($data);
        } catch (Exception $e) {
            Log::error('Error creating medical record: ' . $e->getMessage());
            throw new Exception('Error creating medical record.');
        }
    }

    public function getById(int $id)
    {
        try {
            return MedicalRecord::with(['patient', 'doctor'])->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new Exception('Medical record not found.');
        }
    }

    public function update(array $data, int $id)
    {
        try {
            $record = MedicalRecord::findOrFail($id);
            $record->update($data);
            return $record;
        } catch (ModelNotFoundException $e) {
            throw new Exception('Medical record not found.');
        }
    }

    public function delete(int $id)
    {
        try {
            $record = MedicalRecord::findOrFail($id);
            $record->delete();
        } catch (ModelNotFoundException $e) {
            throw new Exception('Medical record not found.');
        }
    }

    public function getAllPaginated($perPage = 10)
    {
        return MedicalRecord::with(['patient', 'doctor'])->paginate($perPage);
    }
}
