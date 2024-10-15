<?php

namespace Modules\Records\Services;

use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Modules\Records\Models\Prescription;

class PrescriptionService
{
    public function create(array $data)
    {
        try {
            return Prescription::create($data);
        } catch (Exception $e) {
            Log::error('Error creating prescription: ' . $e->getMessage());
            throw new Exception('Error creating prescription.');
        }
    }

    public function getById(int $id)
    {
        try {
            return Prescription::with(['patient', 'doctor'])->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new Exception('Prescription not found.');
        }
    }

    public function update(array $data, int $id)
    {
        try {
            $prescription = Prescription::findOrFail($id);
            $prescription->update($data);
            return $prescription;
        } catch (ModelNotFoundException $e) {
            throw new Exception('Prescription not found.');
        }
    }

    public function delete(int $id)
    {
        try {
            $prescription = Prescription::findOrFail($id);
            $prescription->delete();
        } catch (ModelNotFoundException $e) {
            throw new Exception('Prescription not found.');
        }
    }

    public function getAllPaginated($perPage = 10)
    {
        return Prescription::with(['patient', 'doctor'])->paginate($perPage);
    }
}
