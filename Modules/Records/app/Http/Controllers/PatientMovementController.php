<?php

namespace Modules\Records\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Records\Services\PatientMovementService;
use Modules\Records\Http\Requests\StorePatientMovementRequest;
use Modules\Records\Transformers\PatientMovementResource;
use App\Services\ApiResponseService;

class PatientMovementController extends Controller
{
    protected $service;

    public function __construct(PatientMovementService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $movements = $this->service->getAllPaginated($request->get('per_page', 10));
        return ApiResponseService::paginated($movements, 'Patient movements fetched successfully');
    }

    // public function store(StorePatientMovementRequest $request)
    // {
    //     $movement = $this->service->create($request->validated());
    //     return ApiResponseService::success(new PatientMovementResource($movement), 'Patient movement created successfully');
    // }
    public function registerEntry(Request $request)
    {
        $patientMovement = $this->patientMovementService->registerEntry($request->patient_id);
        return ApiResponseService::success($patientMovement, 'Patient entry registered successfully.');
    }

    // Register patient exit
    public function registerExit($id)
    {
        $patientMovement = $this->patientMovementService->registerExit($id);
        return ApiResponseService::success($patientMovement, 'Patient exit registered successfully.');
    }

    public function show($id)
    {
        $movement = $this->service->getById($id);
        return ApiResponseService::success(new PatientMovementResource($movement), 'Patient movement retrieved successfully');
    }

    public function update(StorePatientMovementRequest $request, $id)
    {
        $movement = $this->service->update($request->validated(), $id);
        return ApiResponseService::success(new PatientMovementResource($movement), 'Patient movement updated successfully');
    }

    public function destroy($id)
    {
        $this->service->delete($id);
        return ApiResponseService::success(null, 'Patient movement deleted successfully');
    }
}
