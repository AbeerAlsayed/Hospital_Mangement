<?php
namespace Modules\Surgeries\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AmbulanceResource extends JsonResource
{
    public function toArray($request): array {
        return [
            'id' => $this->id,
            'driver_name' => $this->driver_name,
            'ambulance_number' => $this->ambulance_number,
            'availability_status' => $this->availability_status,
        ];
    }
}
