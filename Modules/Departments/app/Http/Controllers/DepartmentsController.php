<?php

namespace Modules\Departments\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Departments\Services\DepartmentService;
use Modules\Departments\Http\Requests\DepartmentRequest;
use Modules\Departments\Models\Department;
use Modules\Departments\Transformers\DepartmentResource;
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
        $departments = Department::with(['doctors', 'nurses', 'rooms'])->paginate(10);
        return DepartmentResource::collection($departments);
    }


    public function store(DepartmentRequest $request)
    {
        $department = $this->departmentService->create($request->validated());
        return new DepartmentResource($department);
    }

    public function show(Department $department)
    {
        return new DepartmentResource($department->load(['doctors', 'nurses', 'rooms']));
    }

    public function update(DepartmentRequest $request, Department $department)
    {
        $department = $this->departmentService->update($department, $request->validated());
        return new DepartmentResource($department);
    }

    public function destroy(Department $department)
    {
        $this->departmentService->delete($department);
        return response()->noContent();
    }
}
