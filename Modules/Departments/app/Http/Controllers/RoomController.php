<?php

namespace Modules\Departments\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Modules\Departments\Http\Requests\RoomRequest;
use Modules\Departments\Models\Department;
use Modules\Departments\Models\Room;
use Modules\Departments\Services\RoomService;
use Modules\Departments\Transformers\RoomResource;

class RoomController extends Controller
{
    protected $roomService;

    public function __construct(RoomService $roomService)
    {
        $this->roomService = $roomService;
    }

    public function index(Request $request)
    {
        $perPage = $request->query('per_page', 5);
        $rooms = Room::with(['department', 'patients'])->paginate($perPage);
        return RoomResource::collection($rooms);
    }

    public function store(RoomRequest $request)
    {
        $room = $this->roomService->create($request->validated());
        return response()->json(['message' => 'Department created successfully.', 'data' => $room], 201); // حالة 201 تعني "تم الإنشاء بنجاح"
    }

    public function show($id)
    {
        try {
            // تحميل العلاقة مع الطبيب المسؤول ومع المستخدم المرتبط بالطبيب
            $room = Room::with(['department', 'patients'])->findOrFail($id);
            return new RoomResource($room);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Room not found.'], 404);
        }
    }

    public function update(RoomRequest $request,$id)
    {
        $room = $this->roomService->update($id, $request->validated());
        return new RoomResource($room);
    }

    public function destroy($id)
    {
        $room = Room::findOrFail($id);
        $this->roomService->delete($room);
        return response()->json(['message' => 'Room deleted successfully.'], 200);
    }
}
