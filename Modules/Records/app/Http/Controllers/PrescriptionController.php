<?php

namespace Modules\Records\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Records\Services\PrescriptionService;
use Modules\Records\Http\Requests\StorePrescriptionRequest;
use Modules\Records\Transformers\PrescriptionResource;
use App\Services\ApiResponseService;

class PrescriptionController extends Controller
{
    protected $service;

    public function __construct(PrescriptionService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $prescriptions = $this->service->getAllPaginated($request->get('per_page', 10));
        return ApiResponseService::paginated($prescriptions, 'Prescriptions fetched successfully');
    }

    public function store(StorePrescriptionRequest $request)
    {
        $prescription = $this->service->create($request->validated());
        return ApiResponseService::success(new PrescriptionResource($prescription), 'Prescription created successfully');
    }

    public function show($id)
    {
        $prescription = $this->service->getById($id);
        return ApiResponseService::success(new PrescriptionResource($prescription), 'Prescription retrieved successfully');
    }

    public function update(StorePrescriptionRequest $request, $id)
    {
        $prescription = $this->service->update($request->validated(), $id);
        return ApiResponseService::success(new PrescriptionResource($prescription), 'Prescription updated successfully');
    }

    public function destroy($id)
    {
        $this->service->delete($id);
        return ApiResponseService::success(null, 'Prescription deleted successfully');
    }
}
