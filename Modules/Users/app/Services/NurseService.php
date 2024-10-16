<?php

namespace Modules\Users\Services;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;
use Modules\Users\Models\Nurse;

class NurseService
{
    public function createNurse(array $data)
    {
        try {
            return Nurse::create($data);
        } catch (Exception $e) {
            Log::error('Error creating nurse: ' . $e->getMessage());
            throw new Exception('Error creating nurse.');
        }
    }

    public function getNurse(int $id)
    {
        try {
            return Nurse::with(['user', 'department'])->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new Exception('Nurse not found.');
        }
    }

    public function updateNurse(array $data, int $id)
    {
        try {
            $nurse = Nurse::findOrFail($id);
            $nurse->update(array_filter($data));
            return $nurse;
        } catch (ModelNotFoundException $e) {
            throw new Exception('Nurse not found.');
        }
    }

    public function deleteNurse(int $id)
    {
        try {
            $nurse = Nurse::findOrFail($id);
            $nurse->delete();
        } catch (ModelNotFoundException $e) {
            throw new Exception('Nurse not found.');
        }
    }

    public function getAllNurses($limit = 10)
    {
        return Nurse::with(['user', 'department'])->paginate($limit);
    }
}
