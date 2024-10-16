<?php

namespace Modules\Users\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class NurseResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user' => new UserResource($this->whenLoaded('user')),
            'department' => new DepartmentResource($this->whenLoaded('department')),
            'shift' => $this->shift,
        ];
    }
}
