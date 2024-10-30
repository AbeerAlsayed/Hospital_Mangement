<?php

namespace Modules\Departments\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DepartmentResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'head_doctor' => $this->headDoctor ? $this->headDoctor->user->first_name . ' ' . $this->headDoctor->user->last_name : null, // جلب الاسم الكامل للطبيب
            'head_doctor_id' => $this->head_doctor_id, // إضافة لمعرفة قيمة head_doctor_id
            'doctors' => $this->whenLoaded('doctors', function () {
                // إرجاع فقط اسم الطبيب
                return $this->doctors->map(function ($doctor) {
                    return $doctor->user->first_name . ' ' . $doctor->user->last_name;
                });
            }),
            'rooms' => $this->whenLoaded('rooms', function () {
                // إرجاع فقط رقم الغرفة
                return $this->rooms->map(function ($room) {
                    return $room->room_number;
                });
            }),
            'number_of_rooms' => $this->rooms()->count(),
        ];
    }
}
