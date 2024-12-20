<?php

namespace Modules\Users\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'address' => $this->address,
            'date_of_birth' => $this->date_of_birth,
            'gender' => $this->gender,
            'role' => $this->role,

            'doctor' => $this->when($this->role === 'doctor' && $this->relationLoaded('doctor'), new DoctorResource($this->doctor)),

            'nurse' => $this->when($this->role === 'nurse' && $this->relationLoaded('nurse'), new NurseResource($this->nurse)),

            'patient' => $this->when($this->role === 'patient' && $this->relationLoaded('patient'), new PatientResource($this->patient)),

            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
        ];
    }
}
