<?php

namespace Modules\Shifts\Services;


use Modules\Shifts\Models\ShiftSchedule;

class ShiftScheduleService
{
    public function create(array $data)
    {
        return ShiftSchedule::create($data);
    }

    public function update($id, array $data)
    {
        $shiftSchedule = ShiftSchedule::findOrFail($id);
        $shiftSchedule->update($data);
        return $shiftSchedule;
    }

    public function delete($id)
    {
        $shiftSchedule = ShiftSchedule::findOrFail($id);
        return $shiftSchedule->delete();
    }
}
