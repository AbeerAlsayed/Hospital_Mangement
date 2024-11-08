<?php

namespace Modules\Users\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Users\Models\Patient;
use Modules\Users\Http\Requests\StorePatientRequest;
use Modules\Users\Services\PatientService;
use Modules\Users\Transformers\MedicalRecordResource;
use Modules\Users\Transformers\PatientResource;
use App\Services\ApiResponseService;
use Modules\Users\Transformers\UserResource;

class RecordsController extends Controller
{

    public function index(Request $request)
    {
        // تحميل البيانات مع العلاقات المطلوبة
        $patients = Patient::with([
            'user',
            'doctors.user',
            'rays',
            'laboratories',
            'surgeries.doctor.user'
        ])->get();
        // استخدام المورد لتحويل البيانات
        return MedicalRecordResource::collection($patients);
    }

    public function searchByNationalNumber(Request $request)
    {
        // تحقق من وجود الرقم الوطني في الطلب
        $nationalNumber = $request->input('national_number');
        if (!$nationalNumber) {
            return response()->json(['message' => 'National number is required'], 400);
        }

        // البحث عن المريض باستخدام الرقم الوطني
        $patient = Patient::with([
            'user',
            'doctors.user',
            'rays',
            'laboratories',
            'surgeries.doctor.user'
        ])->where('national_number', $nationalNumber)->first();

        // تحقق من وجود المريض
        if (!$patient) {
            return response()->json(['message' => 'Patient not found'], 404);
        }

        // استخدام المورد لتحويل البيانات
        return new MedicalRecordResource($patient);
    }










}
