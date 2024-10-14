<?php

namespace Modules\Departments\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Departments\Http\Requests\RoomRequest;
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
        $rooms = Room::paginate($perPage);
        return RoomResource::collection($rooms);
    }

    public function store(RoomRequest $request)
    {
        $room = $this->roomService->create($request->validated());
        return new RoomResource($room);
    }

    public function show(Room $room)
    {
        return new RoomResource($room->load('department'));
    }

    public function update(RoomRequest $request, Room $room)
    {
        $room = $this->roomService->update($room, $request->validated());
        return new RoomResource($room);
    }

    public function destroy(Room $room)
    {
        $this->roomService->delete($room);
        return response()->noContent();
    }
}
