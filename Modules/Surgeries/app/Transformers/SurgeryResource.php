<?php
namespace Modules\Surgeries\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SurgeryResource extends JsonResource
{
    public function toArray($request): array {
        return [
            'id' => $this->id,
            'patient' => $this->patient->name,
            'doctor' => $this->doctor->name,
            'type_surgery' => $this->type_surgery,
            'date_scheduled' => $this->date_scheduled,
            'status_surgery' => $this->status_surgery,
        ];
    }
}
