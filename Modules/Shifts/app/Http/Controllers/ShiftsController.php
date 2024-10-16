<?php

namespace Modules\Shifts\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Modules\Shifts\Http\Requests\StoreShiftScheduleRequest;
use Modules\Shifts\Models\ShiftSchedule;
use Modules\Shifts\Services\ShiftScheduleService;
use Modules\Shifts\Transformers\ShiftScheduleResource;

class ShiftsController extends Controller
{
    protected $shiftScheduleService;

    public function __construct(ShiftScheduleService $shiftScheduleService)
    {
        $this->shiftScheduleService = $shiftScheduleService;
    }

    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 5);
        $shiftSchedules = ShiftSchedule::with(['doctor', 'nurse', 'department'])->paginate($perPage);
        return ShiftScheduleResource::collection($shiftSchedules);
    }

    public function store(StoreShiftScheduleRequest $request)
    {
        $shiftSchedule = $this->shiftScheduleService->create($request->validated());
        return response()->json(['message' => 'ShiftSchedule created successfully.', 'data' => $shiftSchedule], 201); // حالة 201 تعني "تم الإنشاء بنجاح"
    }

    public function update(StoreShiftScheduleRequest $request, $id)
    {
        $updatedShiftSchedule = $this->shiftScheduleService->update($id, $request->validated());
        return response()->json(['message' => 'ShiftSchedule updated successfully.', 'data' => $updatedShiftSchedule], 200);
    }

    public function destroy($id)
    {
        $this->shiftScheduleService->delete($id);
        return response()->json(['message' => 'Shift schedule deleted successfully'], 204);
    }

    public function show($id)
    {
        try {
            $shiftSchedule = ShiftSchedule::with(['doctor', 'nurse', 'department'])->findOrFail($id);
            return new ShiftScheduleResource($shiftSchedule);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Shift schedule not found.'], 404);
        }
    }

}
