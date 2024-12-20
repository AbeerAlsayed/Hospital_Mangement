<?php

namespace Modules\Users\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
class MedicalRecordResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'first_name' => $this->user->first_name,
            'last_name' => $this->user->last_name,
            'email' => $this->user->email,
            'phone_number' => $this->user->phone_number,
            'address' => $this->user->address,
            'date_of_birth' => $this->user->date_of_birth,
            'gender' => $this->user->gender,
            'national_number' => $this->national_number,
            'doctors' => $this->doctors->map(function ($doctor) {
                return [
                    'name' => $doctor->user->first_name . ' ' . $doctor->user->last_name,
                    'specialization' => $doctor->specialization,
                    'phone_number' => $doctor->user->phone_number ?? null,
                ];
            }),
            'rays' => $this->rays->map(function ($ray) {
                return [
                    'radiology_type' => $ray->radiology_type,
                    'imaging_date' => $ray->imaging_date,
                    'results' => $ray->results,
                ];
            }),
            'laboratories' => $this->laboratories->map(function ($laboratory) {
                return [
                    'test_name' => $laboratory->test_name,
                    'test_date' => $laboratory->test_date,
                    'results' => $laboratory->results,
                ];
            }),
            'surgeries' => $this->surgeries->map(function ($surgery) {
                return [
                    'doctor_name' => $surgery->doctor
                        ? $surgery->doctor->user->first_name . ' ' . $surgery->doctor->user->last_name
                        : null,
                    'type_surgery' => $surgery->type_surgery,
                    'date_scheduled' => $surgery->date_scheduled,
                ];
            }),
        ];
    }


}


