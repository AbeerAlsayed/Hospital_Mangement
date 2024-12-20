<?php

namespace Modules\Users\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class NurseResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'department' => $this->department->name ?? null,
            'shifts' => ShiftResource::collection($this->shifts),
        ];
    }
}
