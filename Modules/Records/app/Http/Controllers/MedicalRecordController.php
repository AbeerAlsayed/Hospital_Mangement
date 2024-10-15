<?php

namespace Modules\Records\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Records\Services\MedicalRecordService;
use Modules\Records\Http\Requests\StoreMedicalRecordRequest;
use Modules\Records\Transformers\MedicalRecordResource;
use App\Services\ApiResponseService;

class MedicalRecordController extends Controller
{
    protected $service;

    public function __construct(MedicalRecordService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $records = $this->service->getAllPaginated($request->get('per_page', 10));
        return ApiResponseService::paginated($records, 'Medical records fetched successfully');
    }

    public function store(StoreMedicalRecordRequest $request)
    {
        $record = $this->service->create($request->validated());
        return ApiResponseService::success(new MedicalRecordResource($record), 'Medical record created successfully');
    }

    public function show($id)
    {
        $record = $this->service->getById($id);
        return ApiResponseService::success(new MedicalRecordResource($record), 'Medical record retrieved successfully');
    }

    public function update(StoreMedicalRecordRequest $request, $id)
    {
        $record = $this->service->update($request->validated(), $id);
        return ApiResponseService::success(new MedicalRecordResource($record), 'Medical record updated successfully');
    }

    public function destroy($id)
    {
        $this->service->delete($id);
        return ApiResponseService::success(null, 'Medical record deleted successfully');
    }
}
