<?php

namespace Modules\Users\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Users\Models\Doctor;
use Modules\Users\Models\Nurse;
use Modules\Users\Models\Patient;
use Modules\Users\Services\UserService;
use Modules\Users\Http\Requests\StoreUserRequest;
use Modules\Users\Transformers\UserResource;
use App\Services\ApiResponseService;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

// دالة خاصة لإضافة الشفتات للطبيب أو الممرضة
    protected function addShifts($model, $shifts, $department_id)
    {
        if ($shifts) {
            foreach ($shifts as $shift) {
                // التحقق من صحة الشفتات
                if (isset($shift['date'], $shift['start_time'], $shift['end_time'])) {
                    $model->shifts()->create([
                        'date' => $shift['date'],
                        'start_time' => $shift['start_time'],
                        'end_time' => $shift['end_time'],
                        'department_id' => $department_id
                    ]);
                }
            }
        }
    }

// طريقة إنشاء الطبيب
    public function storeDoctor(StoreUserRequest $request)
    {
        // إنشاء مستخدم جديد للطبيب
        $user = $this->userService->createUser(array_merge(
            $request->validated(),
            ['role' => 'doctor']
        ));

        // إنشاء سجل جديد في جدول الأطباء وربط الطبيب بالمستخدم
        $doctor = Doctor::create([
            'user_id' => $user->id,
            'specialization' => $request->input('specialization'),
            'department_id' => $request->input('department_id'),
            'salary' => $request->input('salary')
        ]);

        // إضافة الشفتات
        $this->addShifts($doctor, $request->input('shifts'), $doctor->department_id);

        return ApiResponseService::success(new UserResource($user), 'Doctor created successfully with shifts');
    }

// طريقة إنشاء الممرضة
    public function storeNurse(StoreUserRequest $request)
    {
        // إنشاء مستخدم جديد للممرضة
        $user = $this->userService->createUser(array_merge(
            $request->validated(),
            ['role' => 'nurse']
        ));

        // إنشاء سجل جديد في جدول الممرضات وربط الممرضة بالمستخدم والقسم
        $nurse = Nurse::create([
            'user_id' => $user->id,
            'department_id' => $request->input('department_id')
        ]);

        // إضافة الشفتات
        $this->addShifts($nurse, $request->input('shifts'), $nurse->department_id);

        return ApiResponseService::success(new UserResource($nurse), 'Nurse created successfully with shifts');
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
