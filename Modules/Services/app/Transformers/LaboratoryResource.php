<?php

namespace Modules\Services\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Users\Transformers\DoctorResource;
use Modules\Users\Transformers\PatientResource;

class LaboratoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'test_name' => $this->test_name,
            'test_date' => $this->test_date,
            'results' => $this->results,
            'status' => $this->status,
            'patient' => $this->patient->user->first_name . ' ' . $this->patient->user->last_name,
            'doctor' => $this->doctor->user->first_name . ' ' . $this->doctor->user->last_name,
        ];
    }
}
