<?php

namespace Modules\Users\Services;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Modules\Users\Models\Nurse;

class NurseService
{
    public function createNurse(array $data)
    {
        try {
            return Nurse::create($data);
        } catch (Exception $e) {
            throw new Exception('Error creating nurse.');
        }
    }

    public function getNurse(int $id)
    {
        try {
            return Nurse::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new Exception('Nurse not found.');
        }
    }

    public function getAllNurses()
    {
        return Nurse::all();
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
}
