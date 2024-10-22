<?php

namespace Modules\Shifts\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Departments\Transformers\DepartmentResource;
use Modules\Users\Transformers\DoctorResource;
use Modules\Users\Transformers\NurseResource;

class ShiftScheduleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
                return [
                    'id' => $this->id,
                    'shiftable_type' => $this->shiftable_type,  // Type of the related model (Doctor or Nurse)
                    'shiftable_id' => $this->shiftable_id,      // ID of the related model (Doctor or Nurse)
                    'date' => $this->date,                      // Shift date
                    'start_time' => $this->start_time,          // Shift start time
                    'end_time' => $this->end_time,              // Shift end time
                    'created_at' => $this->created_at,          // When the shift was created
                    'updated_at' => $this->updated_at,          // When the shift was updated
                    'shiftable_name' => $this->shiftable->user->first_name . ' ' . $this->shiftable->user->last_name, // Name of the related entity (Doctor or Nurse)
                ];
    }


}
