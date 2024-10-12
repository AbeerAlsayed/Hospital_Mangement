<?php

namespace Modules\Users\Http\Controllers;

use Modules\Users\Http\Requests\StoreNurseRequest;
use Modules\Users\Services\NurseService;
use App\Services\ApiResponseService;
use Illuminate\Http\JsonResponse;

class NurseController extends Controller
{
    protected $nurseService;

    public function __construct(NurseService $nurseService)
    {
        $this->nurseService = $nurseService;
    }

    public function store(StoreNurseRequest $request): JsonResponse
    {
        $data = $request->validated();
        $nurse = $this->nurseService->createNurse($data);

        return ApiResponseService::success($nurse, 'Nurse created successfully');
    }

    public function show($id): JsonResponse
    {
        $nurse = $this->nurseService->getNurse($id);
        return ApiResponseService::success($nurse, 'Nurse fetched successfully');
    }

    public function getAll(): JsonResponse
    {
        $nurses = $this->nurseService->getAllNurses();
        return ApiResponseService::success($nurses, 'All nurses fetched successfully');
    }

    public function update(StoreNurseRequest $request, $id): JsonResponse
    {
        $data = $request->validated();
        $nurse = $this->nurseService->updateNurse($data, $id);
        return ApiResponseService::success($nurse, 'Nurse updated successfully');
    }

    public function destroy($id): JsonResponse
    {
        $this->nurseService->deleteNurse($id);
        return ApiResponseService::success(null, 'Nurse deleted successfully');
    }
}
