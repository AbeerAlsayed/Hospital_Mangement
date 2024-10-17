<?php

namespace Modules\Appointments\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\ApiResponseService;
use Modules\Appointments\Http\Requests\StoreAppointmentRequest;
use Modules\Appointments\Services\AppointmentService;
use Modules\Appointments\Transformers\AppointmentResource;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    protected $appointmentService;

    public function __construct(AppointmentService $appointmentService)
    {
        $this->appointmentService = $appointmentService;
    }

    public function store(StoreAppointmentRequest $request)
    {
        $data = $request->validated();
        $appointment = $this->appointmentService->createAppointment($data);
        return ApiResponseService::success(new AppointmentResource($appointment), 'Appointment created successfully');
    }

    public function show($id)
    {
        $appointment = $this->appointmentService->getAppointment($id);
        return ApiResponseService::success(new AppointmentResource($appointment), 'Appointment fetched successfully');
    }

    public function update(StoreAppointmentRequest $request, $id)
    {
        $data = $request->validated();
        $appointment = $this->appointmentService->updateAppointment($data, $id);
        return ApiResponseService::success(new AppointmentResource($appointment), 'Appointment updated successfully');
    }

    public function destroy($id)
    {
        $this->appointmentService->deleteAppointment($id);
        return ApiResponseService::success(null, 'Appointment deleted successfully');
    }

    // Method to fetch all appointments with pagination
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10); // default 10 per page
        $appointments = $this->appointmentService->getAllAppointmentsPaginated($perPage);
        return ApiResponseService::paginated($appointments, 'All appointments fetched successfully');
    }
}
