<?php
namespace Modules\Surgeries\Services;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Modules\Surgeries\Models\Surgery;
use Illuminate\Support\Facades\Log;

class SurgeryService
{
    public function createSurgery(array $data) {
        try {
            Log::info('Creating surgery with data: ', $data);
            return Surgery::create($data);
        } catch (Exception $e) {
            Log::error('Error creating surgery: ' . $e->getMessage());
            throw new Exception('Error creating surgery.');
        }
    }


    public function getSurgery(int $id) {
        try {
            return Surgery::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new Exception('Surgery not found.');
        }
    }

    public function updateSurgery(array $data, int $id) {
        try {
            $surgery = Surgery::findOrFail($id);
            $surgery->update(array_filter($data));
            return $surgery;
        } catch (ModelNotFoundException $e) {
            throw new Exception('Surgery not found.');
        }
    }

    public function deleteSurgery(int $id) {
        try {
            $surgery = Surgery::findOrFail($id);
            $surgery->delete();
        } catch (ModelNotFoundException $e) {
            throw new Exception('Surgery not found.');
        }
    }

    public function getAllSurgeriesPaginated($perPage = 10) {
        return Surgery::paginate($perPage);
    }
}

?>
