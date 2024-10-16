<?php

namespace Modules\Users\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Users\Services\PatientService;
use Modules\Users\Http\Requests\StorePatientRequest;
use Modules\Users\Transformers\PatientResource;
use App\Services\ApiResponseService;

class PatientController extends Controller
{
    protected $patientService;

    public function __construct(PatientService $patientService)
    {
        $this->patientService = $patientService;
    }

    public function index()
    {
        $patients = $this->patientService->getAllPatients();
        return ApiResponseService::paginated(
            $patients,
            'Patients fetched successfully'
        );
    }

    public function store(StorePatientRequest $request)
    {
        $patient = $this->patientService->createPatient($request->validated());
        return ApiResponseService::success(
            new PatientResource($patient),
            'Patient created successfully'
        );
    }

    public function show($id)
    {
        $patient = $this->patientService->getPatient($id);
        return ApiResponseService::success(
            new PatientResource($patient),
            'Patient fetched successfully'
        );
    }

    public function update(StorePatientRequest $request, $id)
    {
        $patient = $this->patientService->updatePatient($request->validated(), $id);
        return ApiResponseService::success(
            new PatientResource($patient),
            'Patient updated successfully'
        );
    }

    public function destroy($id)
    {
        $this->patientService->deletePatient($id);
        return ApiResponseService::success(
            null,
            'Patient deleted successfully'
        );
    }
}
