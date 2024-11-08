<?php

namespace Modules\Users\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class DoctorResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'first_name' => $this->user->first_name,  // إرجاع الاسم الأول بشكل منفصل
            'last_name' => $this->user->last_name,    // إرجاع الاسم الأخير بشكل منفصل
            'email' => isset($this->user->email) ? $this->user->email : null,
            'phone_number' => isset($this->user->phone_number) ? $this->user->phone_number : null,
            'address' => isset($this->user->address) ? $this->user->address : null,
            'date_of_birth' => isset($this->user->date_of_birth) ? $this->user->date_of_birth : null,
            'gender' => isset($this->user->gender) ? $this->user->gender : null,
            'specialization' => $this->specialization,
            'department' => isset($this->department->name) ? $this->department->name : null,
            'salary' => $this->salary,

            'shifts' => ShiftResource::collection($this->shifts),
        ];
    }
}
