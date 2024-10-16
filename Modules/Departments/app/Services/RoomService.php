<?php


namespace Modules\Departments\Services;

use Modules\Departments\Models\Room;
use Modules\Services\Models\Ray;

class RoomService
{
    public function create(array $data)
    {
        return Room::create($data);
    }

    public function update($id, array $data)
    {
        $room = Room::findOrFail($id);

        $room->update($data);
        return $room;
    }

    public function delete(Room $room)
    {
        $room->delete();
    }
}
