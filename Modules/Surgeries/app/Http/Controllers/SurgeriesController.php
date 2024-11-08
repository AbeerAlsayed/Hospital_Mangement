<?php

namespace Modules\Surgeries\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\ApiResponseService;
use Illuminate\Http\Request;
use Modules\Surgeries\Http\Requests\StoreSurgeryRequest;
use Modules\Surgeries\Models\Surgery;
use Modules\Surgeries\Services\SurgeryService;
use Modules\Surgeries\Transformers\SurgeryResource;

class SurgeriesController extends Controller
{
    protected $surgeryService;

    public function __construct(SurgeryService $surgeryService) {
        $this->surgeryService = $surgeryService;
    }

    public function store(StoreSurgeryRequest $request) {
        $data = $request->validated();
        $surgery = $this->surgeryService->createSurgery($data);
        return ApiResponseService::success(new SurgeryResource($surgery), 'Surgery created successfully');
    }

    public function show($id) {
        $surgery = $this->surgeryService->getSurgery($id);
        return ApiResponseService::success(new SurgeryResource($surgery), 'Surgery fetched successfully');
    }

    public function update(StoreSurgeryRequest $request, $id) {
        $data = $request->validated();
        $surgery = $this->surgeryService->updateSurgery($data, $id);
        return ApiResponseService::success(new SurgeryResource($surgery), 'Surgery updated successfully');
    }

    public function destroy($id) {
        $this->surgeryService->deleteSurgery($id);
        return ApiResponseService::success(null, 'Surgery deleted successfully');
    }

    public function index(Request $request)
    {
        $perPage = $request->query('per_page', 5);
        $surgeries = Surgery::with(['patient', 'doctor', 'room'])->paginate($perPage);
        return SurgeryResource::collection($surgeries);
    }


    public function filterSurgeries(Request $request)
    {
        $query = Surgery::query();
        if ($request->filled('patient_name')) {
            $query->whereHas('patient', function ($q) use ($request) {
                $q->where(DB::raw("CONCAT(first_name, ' ', last_name)"), 'LIKE', '%' . $request->input('patient_name') . '%');
            });
        }

        // فلترة حسب اسم الطبيب
        if ($request->filled('doctor_name')) {
            $query->whereHas('doctor', function ($q) use ($request) {
                $q->where(DB::raw("CONCAT(first_name, ' ', last_name)"), 'LIKE', '%' . $request->input('doctor_name') . '%');
            });
        }

        // فلترة حسب رقم الغرفة
        if ($request->filled('room_number')) {
            $query->where('room_number', $request->input('room_number'));
        }

        // فلترة حسب نوع الجراحة
        if ($request->filled('type_surgery')) {
            $query->where('type_surgery', 'LIKE', '%' . $request->input('type_surgery') . '%');
        }

        // فلترة حسب تاريخ الجدولة
        if ($request->filled('date_scheduled')) {
            $query->whereDate('date_scheduled', $request->input('date_scheduled'));
        }

        // فلترة حسب حالة الجراحة
        if ($request->filled('status_surgery')) {
            $query->where('status_surgery', $request->input('status_surgery'));
        }

        // تنفيذ الاستعلام وجلب النتائج
        $surgeries = $query->get();

        return SurgeryResource::collection($surgeries);
    }

}
