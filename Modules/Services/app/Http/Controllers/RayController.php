<?php

namespace Modules\Services\Http\Controllers;

use App\Services\ApiResponseService;
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
        return ApiResponseService::success(['message' => 'Rays created successfully.', 'data' => new RayResource($ray)], 201); // حالة 201 تعني "تم الإنشاء بنجاح"
    }

    public function show($id)
    {
        try {
            $ray = Rays::with(['patient', 'doctor'])->findOrFail($id);
            return new RayResource($ray);
        } catch (ModelNotFoundException $e) {
            return ApiResponseService::error(['message' => 'Rays not found.'], 404);
        }
    }

    public function update(StoreRayRequest $request, $id)
    {
        $updatedRay = $this->rayService->update($id, $request->validated());
        return ApiResponseService::success(['message' => 'Rays updated successfully.', 'data' => new RayResource($updatedRay)], 200);
    }

    public function destroy($id)
    {
        $this->rayService->delete($id);
        return ApiResponseService::success(['message' => 'Rays deleted successfully'], 200);
    }
    public function filterRays(Request $request)
    {
        // جلب الفلاتر من الطلب
        $query = Rays::query();


        // فلترة حسب radiology_type
        if ($request->filled('radiology_type')) {
            $query->where('radiology_type', 'LIKE', '%' . $request->input('radiology_type') . '%');
        }

        // فلترة حسب imaging_date
        if ($request->filled('imaging_date')) {
            $query->whereDate('imaging_date', $request->input('imaging_date'));
        }

        // فلترة حسب status
        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        // تنفيذ الاستعلام وجلب البيانات
        $rays = $query->get();

        return RayResource::collection($rays);
    }

}

