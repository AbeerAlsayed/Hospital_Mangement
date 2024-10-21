<?php

namespace Modules\Users\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\ApiResponseService;
use Illuminate\Http\Request;
use Modules\Users\Http\Requests\StoreNurseRequest;
use Modules\Users\Services\NurseService;

class NurseController extends Controller
{
    protected $nurseService;

    public function __construct(NurseService $nurseService)
    {
        $this->nurseService = $nurseService;
    }

    public function store(StoreNurseRequest $request)
    {
        $data = $request->validated();
        $nurse = $this->nurseService->createNurse($data);

        return ApiResponseService::success($nurse, 'Nurse created successfully');
    }

    public function show($id)
    {
        $nurse = $this->nurseService->getNurse($id);
        return ApiResponseService::success($nurse, 'Nurse fetched successfully');
    }

    public function update(StoreNurseRequest $request, $id)
    {
        $data = $request->validated();

        $nurse = $this->nurseService->updateNurse($data, $id);
        return ApiResponseService::success($nurse, 'Nurse updated successfully');
    }

    public function destroy($id)
    {
        $this->nurseService->deleteNurse($id);
        return ApiResponseService::success(null, 'Nurse deleted successfully');
    }

    public function index(Request $request)
    {
        $limit = $request->query('limit', 10); // تحديد عدد النتائج في كل صفحة
        $nurses = $this->nurseService->getAllNurses($limit);
        return ApiResponseService::success($nurses, 'All nurses fetched successfully');
    }
}
