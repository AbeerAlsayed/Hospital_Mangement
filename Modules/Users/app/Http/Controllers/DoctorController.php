<?php

namespace Modules\Users\Http\Controllers;

use Modules\Users\Http\Requests\StoreDoctorRequest;
use Modules\Users\Services\DoctorService;
use App\Services\ApiResponseService;
use Illuminate\Http\JsonResponse;
// use App\Http\Controllers;
class DoctorController extends Controller
{
    protected $doctorService;

    public function __construct(DoctorService $doctorService)
    {
        $this->doctorService = $doctorService;
    }

    public function store(StoreDoctorRequest $request): JsonResponse
    {
        $data = $request->validated();
        $doctor = $this->doctorService->createDoctor($data);

        return ApiResponseService::success($doctor, 'Doctor created successfully');
    }

    public function show($id): JsonResponse
    {
        $doctor = $this->doctorService->getDoctor($id);
        return ApiResponseService::success($doctor, 'Doctor fetched successfully');
    }

    public function getAll(): JsonResponse
    {
        $doctors = $this->doctorService->getAllDoctors();
        return ApiResponseService::success($doctors, 'All doctors fetched successfully');
    }

    public function update(StoreDoctorRequest $request, $id): JsonResponse
    {
        $data = $request->validated();
        $doctor = $this->doctorService->updateDoctor($data, $id);
        return ApiResponseService::success($doctor, 'Doctor updated successfully');
    }

    public function destroy($id): JsonResponse
    {
        $this->doctorService->deleteDoctor($id);
        return ApiResponseService::success(null, 'Doctor deleted successfully');
    }
}
