<?php

namespace Modules\Departments\Http\Controllers;

use App\Services\ApiResponseService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Modules\Departments\Services\DepartmentService;
use Modules\Departments\Http\Requests\DepartmentRequest;
use Modules\Departments\Models\Department;
use Modules\Departments\Transformers\DepartmentResource;
use Modules\Users\Transformers\PatientResource;
use Nwidart\Modules\Routing\Controller;

class DepartmentsController extends Controller
{
    protected $departmentService;

    public function __construct(DepartmentService $departmentService)
    {
        $this->departmentService = $departmentService;
    }

    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 5); // 15 هو عدد العناصر الافتراضي في حال لم يتم تحديد 'per_page'
        $departments = Department::with(['doctors', 'rooms'])->paginate($perPage);
        return DepartmentResource::collection($departments);
    }

    public function store(DepartmentRequest $request)
    {
        $department = $this->departmentService->create($request->validated());
        return ApiResponseService::success(['message' => 'Department created successfully.', 'data' => $department], 201); // حالة 201 تعني "تم الإنشاء بنجاح"
    }

    public function show($id)
    {
        try {
            $department = Department::with(['doctors', 'nurses', 'rooms'])->findOrFail($id);
            return new DepartmentResource($department);
        } catch (ModelNotFoundException $e) {
            return ApiResponseService::error(['message' => 'Department not found.'], 404);
        }
    }

    public function update(DepartmentRequest $request, $id)
    {
        $department = $this->departmentService->update($id, $request->validated());
        return ApiResponseService::success(new DepartmentResource($department), 'Department updated successfully.');
    }


    public function destroy($id)
    {
        $this->departmentService->delete($id);
        return ApiResponseService::success(null, 'Department deleted successfully.');
    }

    public function filterDepartment(Request $request)
    {
        $query = Department::query()->with(['headDoctor.user', 'doctors.user', 'rooms']);

        if ($request->has('name')) {
            $query->where('name', 'LIKE', '%' . $request->input('name') . '%');
        }

        if ($request->has('head_doctor_id')) {
            $query->where('head_doctor_id', $request->input('head_doctor_id'));
        }
        $departments = $query->get();

        return DepartmentResource::collection($query->get());
    }
}
