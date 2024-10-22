<?php

namespace Modules\Records\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Users\Transformers\DoctorResource;
use Modules\Users\Transformers\PatientResource;

class MedicalRecordResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'patient' => new PatientResource($this->whenLoaded('patient')),
            'doctor' => new DoctorResource($this->whenLoaded('doctor')),
            'date' => $this->date,
            'diagnosis' => $this->diagnosis,
            'prescription' => $this->prescription,
            'treatment_plan' => $this->treatment_plan,
            'notes' => $this->notes,
        ];
    }
}
