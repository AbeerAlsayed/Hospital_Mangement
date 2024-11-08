<?php

namespace Modules\Users\Services;

use App\Services\ApiResponseService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\Users\Models\Doctor;
use Modules\Users\Models\Nurse;
use Modules\Users\Models\Patient;
use Modules\Users\Models\User;
use Illuminate\Support\Facades\Hash;
use Modules\Users\Transformers\DoctorResource;
use Modules\Users\Transformers\PatientResource;
use Modules\Users\Transformers\UserResource;

class UserService
{
    private $shiftService;

    public function __construct(ShiftService $shiftService)
    {
        $this->shiftService = $shiftService;
    }

    public function createUser(array $data)
    {
        $data['password'] = Hash::make($data['password']);
        return User::create($data);
    }

    public function createDoctorWithUser(array $userData, array $doctorData, array $shifts)
    {
        DB::beginTransaction();
        try {
            Log::info('Starting doctor and user creation');
            $user = $this->createUser($userData);
            $doctor = Doctor::create([
                'user_id' => $user->id,
                'specialization' => $doctorData['specialization'],
                'department_id' => $doctorData['department_id'],
                'salary' => $doctorData['salary']
            ]);
            $this->shiftService->assignShifts($doctor, $shifts);
            DB::commit();
            Log::info('Doctor created with ID: ' . $doctor->id);
            return ApiResponseService::success(new DoctorResource($doctor), 'Doctor created successfully with shifts');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error in doctor creation: ' . $e->getMessage());
            return ApiResponseService::error('Failed to create doctor', 500);
        }
    }

    public function createPatientWithUser(array $userData, array $patientData)
    {
        DB::beginTransaction();
        try {
            Log::info('Starting patient and user creation');

            // إزالة `national_number` و `room_id` من بيانات المستخدم
            unset($userData['national_number'], $userData['room_id']);

            // إنشاء المستخدم
            $user = $this->createUser($userData);

            // إنشاء سجل جديد في جدول المرضى
            $patient = Patient::create([
                'user_id' => $user->id,  // ربط المريض بالمستخدم
                'room_id' => $patientData['room_id'],
                'national_number' => $patientData['national_number'],
            ]);

            DB::commit(); // تأكيد المعاملة

            Log::info('Patient created with ID: ' . $patient->id);
            return ApiResponseService::success(new PatientResource($patient), 'Patient created successfully');
        } catch (\Exception $e) {
            DB::rollBack(); // التراجع عن المعاملة في حال حدوث خطأ
            Log::error('Error in patient creation: ' . $e->getMessage());
            return ApiResponseService::error('Failed to create patient', 500);
        }
    }


    public function createNurseWithUser(array $userData, array $nurseData, array $shifts)
    {
        DB::beginTransaction();
        try {
            Log::info('Starting nurse and user creation');
            $user = $this->createUser($userData);

            $nurse = Nurse::create([
                'user_id' => $user->id,
                'department_id' => $nurseData['department_id']
            ]);
            $this->shiftService->assignShifts($nurse, $shifts);
            DB::commit();
            Log::info('Nurse created with ID: ' . $nurse->id);
            return ApiResponseService::success(new UserResource($user), 'Nurse created successfully with shifts');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error in nurse creation: ' . $e->getMessage());
            return ApiResponseService::error('Failed to create nurse', 500);
        }
    }
}
