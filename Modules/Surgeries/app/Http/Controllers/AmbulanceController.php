<?php
namespace Modules\Surgeries\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\ApiResponseService;
use Modules\Surgeries\Http\Requests\StoreAmbulanceRequest;
use Modules\Surgeries\Services\AmbulanceService;

class AmbulanceController extends Controller
{
    protected $ambulanceService;

    public function __construct(AmbulanceService $ambulanceService) {
        $this->ambulanceService = $ambulanceService;
    }

    public function store(StoreAmbulanceRequest $request) {
        $data = $request->validated();
        $ambulance = $this->ambulanceService->createAmbulance($data);
        return ApiResponseService::success($ambulance, 'Ambulance created successfully');
    }

    public function show($id) {
        $ambulance = $this->ambulanceService->getAmbulance($id);
        return ApiResponseService::success($ambulance, 'Ambulance fetched successfully');
    }

    public function update(StoreAmbulanceRequest $request, $id) {
        $data = $request->validated();
        $ambulance = $this->ambulanceService->updateAmbulance($data, $id);
        return ApiResponseService::success($ambulance, 'Ambulance updated successfully');
    }

    public function destroy($id) {
        $this->ambulanceService->deleteAmbulance($id);
        return ApiResponseService::success(null, 'Ambulance deleted successfully');
    }

    public function index() {
        $ambulances = $this->ambulanceService->getAllAmbulancesPaginated(10);
        return ApiResponseService::success($ambulances, 'Ambulances fetched successfully');
    }
}
