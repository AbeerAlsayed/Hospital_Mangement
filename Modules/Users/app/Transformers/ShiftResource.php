<?php

namespace Modules\Users\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;


class ShiftResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'date' => $this->date,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'session_period'=>$this->session_period,

        ];
    }
}
