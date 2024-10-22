<?php

namespace Modules\Services\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Services\Http\Requests\StoreLaboratoryRequest;
use Modules\Services\Http\Requests\StoreRayRequest;
use Modules\Services\Models\Laboratory;
use Modules\Services\Models\Rays;
use Modules\Services\Services\LaboratoryService;
use Modules\Services\Services\RayService;
use Modules\Services\Transformers\LaboratoryResource;
use Modules\Services\Transformers\RayResource;

class LaboratoryController extends Controller
{
    protected $laboratoryService;

    public function __construct(LaboratoryService $laboratoryService)
    {
        $this->laboratoryService = $laboratoryService;
    }

    public function store(StoreLaboratoryRequest $request)
    {
        $laboratory = $this->laboratoryService->create($request->validated());
        return response()->json(['message' => 'Laboratory created successfully.', 'data' => $laboratory], 201); // حالة 201 تعني "تم الإنشاء بنجاح"
    }

    public function update(StoreLaboratoryRequest $request,$id)
    {
        $updatedLaboratory = $this->laboratoryService->update($id, $request->validated());
        return response()->json(['message' => 'Laboratory updated successfully.', 'data' => $updatedLaboratory], 200);
    }

    public function destroy($id)
    {
        $this->laboratoryService->delete($id);
        return response()->json(['message' => 'Laboratory test deleted successfully'], 200);
    }

    public function show($id)
    {
        try {
            $laboratory = Laboratory::with(['patient', 'doctor'])->findOrFail($id);
            return new LaboratoryResource($laboratory);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Laboratory not found.'], 404);
        }
    }

    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 5);
        $laboratories = Laboratory::with(['patient', 'doctor'])->paginate($perPage);
        return LaboratoryResource::collection($laboratories);
    }
}
