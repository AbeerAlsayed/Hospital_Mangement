<?php

namespace Modules\Records\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Records\Models\MedicalRecord;
use Modules\Records\Services\MedicalRecordService;
use Modules\Records\Http\Requests\StoreMedicalRecordRequest;
use Modules\Records\Transformers\MedicalRecordResource;
use App\Services\ApiResponseService;
use Modules\Users\Models\Patient;
use Modules\Users\Services\PatientService;
use Modules\Users\Transformers\PatientResource;

class RecordsController extends Controller
{

    public function index(Request $request)
    {
        $patients = Patient::with(['user', 'doctors.user', 'rays', 'laboratories', 'surgeries.doctor.user'])->get();
        return MedicalRecordResource::collection($patients);
    }







    public function show($id)
    {
        $record = $this->service->getById($id);
        return ApiResponseService::success(new MedicalRecordResource($record), 'Medical record retrieved successfully');
    }


    public function destroy($id)
    {
        $this->service->delete($id);
        return ApiResponseService::success(null, 'Medical record deleted successfully');
    }
}
