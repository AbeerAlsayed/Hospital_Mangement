<?php

namespace Modules\Users\Services;

use Illuminate\Support\Facades\Log;
use Modules\Shifts\Models\ShiftSchedule;


class ShiftService
{
    public function assignShifts($model, $shifts)
    {
        if (is_array($shifts)) {
            foreach ($shifts as $shift) {

                ShiftSchedule::create([
                    'shiftable_type' => get_class($model), // نوع الكيان (طبيب أو ممرضة)
                    'shiftable_id' => $model->id,          // معرف الكيان
                    'date' => $shift['date'],
                    'start_time' => $shift['start_time'],
                    'end_time' => $shift['end_time'],
                ]);
            }
        }
    }

}
