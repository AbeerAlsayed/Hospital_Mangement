<?php

namespace Modules\Users\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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
    private $shiftService;

    public function __construct(UserService $userService, ShiftService $shiftService)
    {
        $this->userService = $userService;
        $this->shiftService = $shiftService;
    }


    public function storeDoctor(StoreUserRequest $request)
    {
        Log::info('Starting doctor creation');  // سجل بداية العملية

        // إنشاء المستخدم
        $user = $this->userService->createUser(array_merge(
            $request->validated(),
            ['role' => 'doctor']
        ));

        // إنشاء الطبيب
        $doctor = Doctor::create([
            'user_id' => $user->id,
            'specialization' => $request->input('specialization'),
            'department_id' => $request->input('department_id'),
            'salary' => $request->input('salary')
        ]);

        Log::info('Doctor created with ID: ' . $doctor->id);  // سجل نجاح إنشاء الطبيب

        // تعيين الشفتات للطبيب
        $this->shiftService->assignShifts($doctor, $request->input('shifts'));

        // تحميل علاقات الطبيب بعد الإنشاء
        $user->load('doctor.shifts', 'doctor.department', 'doctor.patients');

        Log::info('Shifts loaded for Doctor ID: ' . $doctor->id);  // سجل نجاح تحميل الشفتات

        // إرجاع الرد النهائي
        return ApiResponseService::success(new UserResource($user), 'Doctor created successfully with shifts');
    }


    public function storeNurse(StoreUserRequest $request)
    {
        DB::beginTransaction();

        try {
            $user = $this->userService->createUser(array_merge(
                $request->validated(),
                ['role' => 'nurse']
            ));

            $nurse = Nurse::create([
                'user_id' => $user->id,
                'department_id' => $request->input('department_id')
            ]);

            $this->shiftService->assignShifts($nurse, $request->input('shifts'));

            $user->load('nurse.shifts', 'nurse.department');

            DB::commit();

            return ApiResponseService::success(new UserResource($user), 'Nurse created successfully with shifts');
        } catch (\Exception $e) {
            DB::rollBack();
            return ApiResponseService::error('Nurse creation failed: ' . $e->getMessage(), 500);
        }
    }


    public function storePatient(StoreUserRequest $request)
    {
        // إنشاء مستخدم جديد
        $user = $this->userService->createUser(array_merge(
            $request->validated(),
            ['role' => 'patient'] // تحديد الدور كـ مريض
        ));

        // إنشاء سجل جديد في جدول المرضى وربط المريض بالمستخدم والغرفة فقط
        $patient = Patient::create([
            'user_id' => $user->id,
            'room_id' => $request->input('room_id') // تأكد من تمرير room_id
        ]);

        // ربط المريض مع الأطباء (علاقة many-to-many) باستخدام الجدول الوسيط
        $doctorIds = $request->input('doctor_id'); // افتراض أن doctor_id هو array
        if ($doctorIds) {
            $patient->doctors()->attach($doctorIds); // استخدام attach لربط الأطباء بالمريض
        }

        // تحميل العلاقات "doctors" و "room" للمريض
        $patient->load('doctors', 'room');

        // تحميل العلاقات "patient" في المستخدم
        $user->load('patient.doctors', 'patient.room');

        return ApiResponseService::success(new UserResource($user), 'Patient created successfully');
    }


}
