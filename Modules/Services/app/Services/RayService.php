<?php

namespace Modules\Services\Services;

use Modules\Rays\Http\Requests\StoreRayRequest;
use Modules\Services\Models\Rays;

class RayService
{
    public function create(array $data): Ray
    {
        return Rays::create($data);
    }

    public function update($id, array $data): Ray
    {
        $ray = Rays::findOrFail($id);
        $ray->update($data);
        return $ray;
    }

    public function delete($id): bool
    {
        $ray = Rays::findOrFail($id);
        return $ray->delete();
    }
}
