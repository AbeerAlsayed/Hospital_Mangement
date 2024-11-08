<?php

namespace Modules\Users\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
class PatientResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'first_name' => $this->user->first_name,  // إرجاع الاسم الأول بشكل منفصل
            'last_name' => $this->user->last_name,    // إرجاع الاسم الأخير بشكل منفصل
            'email' => $this->user->email,
            'phone_number' => $this->user->phone_number,
            'address' => $this->user->address,
            'date_of_birth' => $this->user->date_of_birth,
            'gender' => $this->user->gender,
            'room' => $this->room->room_number, // تأكد من وجود حقل name في جدول الغرف
            'national_number' => $this->national_number,
        ];

    }
}
