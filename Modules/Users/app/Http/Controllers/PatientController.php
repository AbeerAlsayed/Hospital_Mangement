<?php

namespace Modules\Users\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Users\Models\Patient;
use Modules\Users\Http\Requests\StorePatientRequest;
use Modules\Users\Services\PatientService;
use Modules\Users\Transformers\PatientResource;
use App\Services\ApiResponseService;
use Modules\Users\Transformers\UserResource;

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
        $patientResource = PatientResource::collection($patients);
        return ApiResponseService::paginated(
            $patients->setCollection(PatientResource::collection($patients->getCollection())->collection),
            'Patients fetched successfully'
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


    public function findPatients(Request $request)
    {
        $query = Patient::query();

        if ($request->has('national_number')) {
            $query->where('national_number', $request->input('national_number'));
        }

        if ($request->has('email')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('email', $request->input('email'));
            });
        }

        if ($request->has('phone_number')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('phone_number', $request->input('phone_number'));
            });
        }

        if ($request->has('room_number')) {
            $query->whereHas('room', function ($q) use ($request) {
                $q->where('room_number', $request->input('room_number'));
            });
        }

        if ($request->has('first_name') && $request->has('last_name')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('first_name', $request->input('first_name'))
                    ->where('last_name', $request->input('last_name'));
            });
        }

        return PatientResource::collection($query->get());
    }

}
