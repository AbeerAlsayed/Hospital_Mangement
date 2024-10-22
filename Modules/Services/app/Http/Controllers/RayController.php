<?php

namespace Modules\Services\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Departments\Models\Department;
use Modules\Services\Http\Requests\StoreRayRequest;
use Modules\Services\Models\Rays;
use Modules\Services\Services\RayService;
use Modules\Services\Transformers\RayResource;

class RayController extends Controller
{
    protected $rayService;

    public function __construct(RayService $rayService)
    {
        $this->rayService = $rayService;
    }

    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 5);
        $rays = Rays::with(['patient', 'doctor'])->paginate($perPage);
        return RayResource::collection($rays);
    }

    public function store(StoreRayRequest $request)
    {
        $ray = $this->rayService->create($request->validated());
        return response()->json(['message' => 'Rays created successfully.', 'data' => $ray], 201); // حالة 201 تعني "تم الإنشاء بنجاح"
    }

    public function show($id)
    {
        try {
            $ray = Rays::with(['patient', 'doctor'])->findOrFail($id);
            return new RayResource($ray);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Rays not found.'], 404);
        }
    }

    public function update(StoreRayRequest $request, $id)
    {
        $updatedRay = $this->rayService->update($id, $request->validated());
        return response()->json(['message' => 'Rays updated successfully.', 'data' => $updatedRay], 200);
    }

    public function destroy($id)
    {
        $this->rayService->delete($id);
        return response()->json(['message' => 'Rays deleted successfully'], 200);
    }


}

