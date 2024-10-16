<?php
namespace Modules\Surgeries\Services;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Modules\Surgeries\Models\Ambulance;
use Illuminate\Support\Facades\Log;

class AmbulanceService
{
    public function createAmbulance(array $data) {
        try {
            return Ambulance::create($data);
        } catch (Exception $e) {
            Log::error('Error creating ambulance: ' . $e->getMessage());
            throw new Exception('Error creating ambulance.');
        }
    }

    public function getAmbulance(int $id) {
        try {
            return Ambulance::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new Exception('Ambulance not found.');
        }
    }

    public function updateAmbulance(array $data, int $id) {
        try {
            $ambulance = Ambulance::findOrFail($id);
            $ambulance->update(array_filter($data));
            return $ambulance;
        } catch (ModelNotFoundException $e) {
            throw new Exception('Ambulance not found.');
        }
    }

    public function deleteAmbulance(int $id) {
        try {
            $ambulance = Ambulance::findOrFail($id);
            $ambulance->delete();
        } catch (ModelNotFoundException $e) {
            throw new Exception('Ambulance not found.');
        }
    }

    public function getAllAmbulancesPaginated($perPage = 10) {
        return Ambulance::paginate($perPage);
    }
}
