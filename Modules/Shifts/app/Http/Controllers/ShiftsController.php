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

        // جلب بيانات الشيفتات مع الكيان المرتبط (يمكن أن يكون Doctor أو Nurse)
        $shiftSchedules = ShiftSchedule::with(['shiftable.user'])->paginate($perPage);

        // إرجاع الشيفتات باستخدام الـ Resource
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
        return response()->json(['message' => 'Shift schedule deleted successfully'], 200);
    }

    public function show($id)
    {
        $shiftSchedule = ShiftSchedule::findOrFail($id);

        // Return the shift schedule as a resource
        return new ShiftScheduleResource($shiftSchedule);
    }

}
