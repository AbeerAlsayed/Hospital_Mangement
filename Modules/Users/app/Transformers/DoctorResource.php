<?php

namespace Modules\Users\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DoctorResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user' => [
                'first_name' => $this->user->first_name,
                'last_name' => $this->user->last_name,
                'email' => $this->user->email,
                'phone' => $this->user->phone,
                'address' => $this->user->address,
                'date_of_birth' => $this->user->date_of_birth,
            ],
            'specialization' => $this->specialization,
            'department_id' => $this->department_id,
            'salary' => $this->salary,
        ];
    }
}