<?php

namespace Modules\Users\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Users\Models\Doctor;
use Modules\Users\Services\DoctorService;
use Modules\Users\Http\Requests\StoreDoctorRequest;
use Modules\Users\Transformers\DoctorResource;
use App\Services\ApiResponseService;

class DoctorController extends Controller
{
    protected $doctorService;

    public function __construct(DoctorService $doctorService)
    {
        $this->doctorService = $doctorService;
    }

    public function index()
    {
        $doctors = $this->doctorService->getAllDoctors();
        $doctorResource = DoctorResource::collection($doctors);
        return ApiResponseService::paginated(
            $doctors->setCollection(DoctorResource::collection($doctors->getCollection())->collection),
            'Doctors fetched successfully'
        );
    }


    public function show($id)
    {
        $doctor = $this->doctorService->getDoctor($id);
        return ApiResponseService::success(
            new DoctorResource($doctor),
            'Doctor fetched successfully'
        );
    }

    public function update(StoreDoctorRequest $request, $id)
    {
        $doctor = $this->doctorService->updateDoctor($request->validated(), $id);
        return ApiResponseService::success(
            new DoctorResource($doctor),
            'Doctor updated successfully'
        );
    }

    public function destroy($id)
    {
        $this->doctorService->deleteDoctor($id);
        return ApiResponseService::success(
            null,
            'Doctor deleted successfully'
        );
    }
}
