<?php

namespace Modules\Users\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class PatientResource extends JsonResource
{
    public function toArray($request)
    {
        return [
        'id' => $this->id,
        'room' => $this->room ? $this->room->name : null,  // معلومات الغرفة
        'doctors' => DoctorResource::collection($this->doctors),  // قائمة الأطباء المرتبطين بالمريض
    ];
    }
}
