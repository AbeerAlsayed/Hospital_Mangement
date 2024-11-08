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
        $shiftableUser = optional($this->shiftable->user);

        return [
            'id' => $this->id,
            'shiftable_type' => $this->shiftable_type,
            'shiftable_id' => $this->shiftable_id,
            'date' => $this->date,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'shiftable_name' => $shiftableUser ? $shiftableUser->first_name . ' ' . $shiftableUser->last_name : 'No name assigned',
            'shiftable_user_exists' => $shiftableUser ? true : false, // تحقق من وجود المستخدم
        ];
    }



}
