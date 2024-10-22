<?php
namespace Modules\Surgeries\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SurgeryResource extends JsonResource
{
    public function toArray($request): array {
        return [
            'id' => $this->id,
            'patient_name' => $this->patient ? $this->patient->user->first_name . ' ' . $this->patient->user->last_name: null,  // Include patient's name

            'doctor_name' => $this->doctor ? $this->doctor->user->first_name . ' ' . $this->doctor->user->last_name : null,     // Include doctor's name
            'room_number' => $this->room ? $this->room->room_number : null,       // Include room number
            'type_surgery' => $this->type_surgery,
            'date_scheduled' => $this->date_scheduled,
            'status_surgery' => $this->status_surgery,

        ];
    }
}
