<?php

namespace Modules\Services\Services;

use Modules\Services\Models\Laboratory;

class LaboratoryService
{
    public function create(array $data): Laboratory
    {
        return Laboratory::create($data);
    }

    public function update($id, array $data)
    {
        $laboratory = Laboratory::findOrFail($id);
        $laboratory->update($data);
        return $laboratory;
    }

    public function delete($id): bool
    {
        $laboratory = Laboratory::findOrFail($id);
        return $laboratory->delete();
    }
}
