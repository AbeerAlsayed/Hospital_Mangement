<?php

namespace Modules\Surgeries\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\ApiResponseService;
use Modules\Surgeries\Http\Requests\StoreSurgeryRequest;
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
        return ApiResponseService::success($surgery, 'Surgery created successfully');
    }

    public function show($id) {
        $surgery = $this->surgeryService->getSurgery($id);
        return ApiResponseService::success(new SurgeryResource($surgery), 'Surgery fetched successfully');
    }

    public function update(StoreSurgeryRequest $request, $id) {
        $data = $request->validated();
        $surgery = $this->surgeryService->updateSurgery($data, $id);
        return ApiResponseService::success($surgery, 'Surgery updated successfully');
    }

    public function destroy($id) {
        $this->surgeryService->deleteSurgery($id);
        return ApiResponseService::success(null, 'Surgery deleted successfully');
    }

    public function index() {
        $surgeries = $this->surgeryService->getAllSurgeriesPaginated(10);
        return ApiResponseService::success($surgeries, 'Surgeries fetched successfully');
    }
}
