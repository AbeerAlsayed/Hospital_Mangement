<?php

namespace Modules\Departments\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;



class DepartmentResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'head_doctor_id' => $this->head_doctor_id,
            'doctors' => $this->whenLoaded('doctors'),
            'nurses' => $this->whenLoaded('nurses'),
            'rooms' => $this->whenLoaded('rooms'),
            'shiftSchedules' => $this->whenLoaded('shiftSchedules'),
        ];
    }
}
