<?php

namespace Modules\Users\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class DoctorResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user' => new UserResource($this->user),
            'specialization' => $this->specialization,
            'department' => new DepartmentResource($this->department),
            'salary' => $this->salary,
            'patients' => PatientResource::collection($this->whenLoaded('patients')),
        ];
    }
}
