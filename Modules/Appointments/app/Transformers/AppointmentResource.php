<?php
namespace Modules\Appointments\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class AppointmentResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'appointment_date' => $this->appointment_date,
            'time' => $this->time,
            'status' => $this->status,
            'patient' => new PatientResource($this->patient), // Assuming PatientResource exists
            'doctor' => new DoctorResource($this->doctor), // Assuming DoctorResource exists
        ];
    }
}

