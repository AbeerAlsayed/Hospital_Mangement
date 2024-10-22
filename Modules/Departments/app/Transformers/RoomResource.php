<?php

namespace Modules\Departments\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Surgeries\Transformers\SurgeryResource;
use Modules\Users\Transformers\PatientResource;

class RoomResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'room_number' => $this->room_number,
            'status' => $this->status,
            'type' => $this->type,
            'department_name' => $this->department ? $this->department->name : null,  // Include department name if it exists
            'patients' => $this->patients->map(function ($patient) {
                return $patient->user->first_name . ' ' . $patient->user->last_name;  // Use both first_name and last_name from user relationship
            }),
        ];
    }
}
