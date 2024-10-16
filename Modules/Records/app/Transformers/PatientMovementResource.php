<?php

namespace Modules\Records\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class PatientMovementResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'patient' => new PatientResource($this->whenLoaded('patient')),
            'entry_time' => $this->entry_time,
            'exit_time' => $this->exit_time,
        ];
    }
}
