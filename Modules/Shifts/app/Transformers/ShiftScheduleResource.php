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
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'doctor' => new DoctorResource($this->whenLoaded('doctor')),
            'nurse' => new NurseResource($this->whenLoaded('nurse')),
            'department' => new DepartmentResource($this->whenLoaded('department')),
            'date' => $this->date,
            'time' => $this->time,
        ];
    }
}
