<?php

namespace Modules\Users\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\Users\Http\Requests\StoreDoctorRequest;
use Modules\Users\Http\Requests\StorePatientRequest;
use Modules\Users\Models\Doctor;
use Modules\Users\Models\Nurse;
use Modules\Users\Models\Patient;
use Modules\Users\Services\ShiftService;
use Modules\Users\Services\UserService;
use Modules\Users\Http\Requests\StoreUserRequest;
use Modules\Users\Transformers\UserResource;
use App\Services\ApiResponseService;

class UsersController extends Controller
{
    protected $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function storeDoctor(StoreDoctorRequest $request)
    {
        $userData = array_merge(
            $request->validated(),
            ['role' => 'doctor']
        );
        $doctorData = $request->only(['specialization', 'department_id', 'salary']);
        $shifts = $request->input('shifts', []);
        return $this->userService->createDoctorWithUser($userData, $doctorData, $shifts);
    }

    public function storePatient(StorePatientRequest $request)
    {
        $userData = array_merge(
            $request->validated(),
            ['role' => 'patient']
        );

        $patientData = $request->only(['room_id', 'national_number']);
        return $this->userService->createPatientWithUser($userData, $patientData);
    }

    public function storeNurse(StoreUserRequest $request)
    {
        $userData = array_merge(
            $request->validated(),
            ['role' => 'nurse']
        );
        $nurseData = $request->only(['department_id']);
        $shifts = $request->input('shifts', []);
        return $this->userService->createNurseWithUser($userData, $nurseData, $shifts);
    }
}
