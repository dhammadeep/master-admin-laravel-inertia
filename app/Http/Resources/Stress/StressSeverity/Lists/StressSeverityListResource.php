<?php

namespace App\Http\Resources\Stress\StressSeverity\Lists;

use Illuminate\Http\Resources\Json\JsonResource;

class StressSeverityListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'Name' => $this->Name,
            'Value' => $this->Value,
            'MinBand' => $this->MinBand,
            'MaxBand' => $this->MaxBand,
        ];
    }
}
