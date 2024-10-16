<?php

namespace Modules\Records\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class PrescriptionResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'patient' => new PatientResource($this->whenLoaded('patient')),
            'doctor' => new DoctorResource($this->whenLoaded('doctor')),
            'medication' => $this->medication,
            'dosage' => $this->dosage,
            'duration' => $this->duration,
            'instructions' => $this->instructions,
        ];
    }
}
