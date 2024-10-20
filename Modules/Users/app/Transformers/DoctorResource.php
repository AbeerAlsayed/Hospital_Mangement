<?php

namespace Modules\Users\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class DoctorResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'specialization' => $this->specialization ?? null,
            'department' => $this->department->name ?? null,
            'salary' => $this->salary ?? null,
            'patients' => $this->patients ? $this->patients->pluck('name') : [],
            'shifts' => ShiftResource::collection($this->shifts),
        ];
    }
}
