<?php

namespace Modules\Services\Http\Controllers;

use App\Services\ApiResponseService;
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
        return ApiResponseService::success(['message' => 'Laboratory created successfully.', 'data' =>new LaboratoryResource($laboratory) ], 201); // حالة 201 تعني "تم الإنشاء بنجاح"
    }

    public function update(StoreLaboratoryRequest $request,$id)
    {
        $updatedLaboratory = $this->laboratoryService->update($id, $request->validated());
        return ApiResponseService::success(['message' => 'Laboratory updated successfully.', 'data' =>new LaboratoryResource($updatedLaboratory)], 200);
    }

    public function destroy($id)
    {
        $this->laboratoryService->delete($id);
        return ApiResponseService::success(['message' => 'Laboratory test deleted successfully'], 200);
    }

    public function show($id)
    {
        try {
            $laboratory = Laboratory::with(['patient', 'doctor'])->findOrFail($id);
            return new LaboratoryResource($laboratory);
        } catch (ModelNotFoundException $e) {
            return ApiResponseService::error(['message' => 'Laboratory not found.'], 404);
        }
    }

    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 5);
        $laboratories = Laboratory::with(['patient', 'doctor'])->paginate($perPage);
        return LaboratoryResource::collection($laboratories);
    }

    public function filterLaboratories(Request $request)
    {
        $query = Laboratory::query();


        if ($request->filled('test_name')) {
            $query->where('test_name', 'LIKE', '%' . $request->input('test_name') . '%');
        }

        if ($request->filled('doctor_id')) {
            $query->where('doctor_id', $request->input('doctor_id'));
        }

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }
        if ($request->filled('test_date')) {
            $query->whereDate('test_date', $request->input('test_date'));
        }

        if ($request->filled('results')) {
            $query->where('results', $request->input('results'));
        }

        $laboratories = $query->get();


        return LaboratoryResource::collection($laboratories);
    }


}
