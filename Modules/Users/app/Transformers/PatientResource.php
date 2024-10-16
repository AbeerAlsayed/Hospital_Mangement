<?php

namespace Modules\Users\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class PatientResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user' => new UserResource($this->user),
            'room' => new RoomResource($this->room),
            'doctors' => DoctorResource::collection($this->whenLoaded('doctors')),
        ];
    }
}
