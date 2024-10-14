<?php


namespace Modules\Departments\Services;

use Modules\Departments\Models\Room;

class RoomService
{
    public function create(array $data)
    {
        return Room::create($data);
    }

    public function update(Room $room, array $data)
    {
        $room->update($data);
        return $room;
    }

    public function delete(Room $room)
    {
        $room->delete();
    }
}
