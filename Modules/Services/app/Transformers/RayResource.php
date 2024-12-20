<?php

namespace Modules\Services\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Users\Transformers\DoctorResource;
use Modules\Users\Transformers\PatientResource;

class RayResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray(\Illuminate\Http\Request $request): array
    {
        return [
            'id' => $this->id,
            'patient' => $this->patient->user->first_name . ' ' . $this->patient->user->last_name,
            'doctor' => $this->doctor->user->first_name . ' ' . $this->doctor->user->last_name,
            'radiology_type' => $this->radiology_type,
            'imaging_date' => $this->imaging_date,
            'results' => $this->results,
            'status' => $this->status,

        ];
    }
}
