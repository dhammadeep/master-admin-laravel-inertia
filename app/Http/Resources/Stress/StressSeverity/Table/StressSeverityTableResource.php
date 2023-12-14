<?php

namespace App\Http\Resources\Stress\StressSeverity\Table;

use Illuminate\Http\Resources\Json\JsonResource;

class StressSeverityTableResource extends JsonResource
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
            'ID' => $this->ID,
            'Name' => $this->Name,
            'Value' => $this->Value,
            'MinBand' => $this->MinBand,
            'MaxBand' => $this->MaxBand,
            'Status' => $this->Status,
        ];
    }
}
