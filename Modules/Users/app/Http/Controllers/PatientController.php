<?php

namespace Modules\Users\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Users\Http\Requests\StorePatientRequest;
use Modules\Users\Services\PatientService;
use App\Services\ApiResponseService;
use Illuminate\Http\JsonResponse;

class PatientController extends Controller
{
    protected $patientService;

    public function __construct(PatientService $patientService)
    {
        $this->patientService = $patientService;
    }

    public function store(StorePatientRequest $request): JsonResponse
    {
        $data = $request->validated();
        $patient = $this->patientService->createPatient($data);

        return ApiResponseService::success($patient, 'Patient created successfully');
    }

    public function show($id): JsonResponse
    {
        $patient = $this->patientService->getPatient($id);
        return ApiResponseService::success($patient, 'Patient fetched successfully');
    }

    public function getAll(): JsonResponse
    {
        $patients = $this->patientService->getAllPatients();
        return ApiResponseService::success($patients, 'All patients fetched successfully');
    }

    public function update(StorePatientRequest $request, $id): JsonResponse
    {
        $data = $request->validated();
        $patient = $this->patientService->updatePatient($data, $id);
        return ApiResponseService::success($patient, 'Patient updated successfully');
    }

    public function destroy($id): JsonResponse
    {
        $this->patientService->deletePatient($id);
        return ApiResponseService::success(null, 'Patient deleted successfully');
    }
}
