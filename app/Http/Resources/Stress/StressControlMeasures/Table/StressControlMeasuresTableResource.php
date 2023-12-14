<?php

namespace App\Http\Resources\Stress\StressControlMeasures\Table;

use Illuminate\Http\Resources\Json\JsonResource;

class StressControlMeasuresTableResource extends JsonResource
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
            'CommodityName' => $this->commodity->Name ?? '',
            'StressName' => $this->stress->Name ?? '',
            'StressSeverityName' => $this->stressSeverity->Name ?? '',
            'StressControlMeasureName' => $this->stressControlMeasure->Name ?? '',
            'Status' => $this->Status,
        ];
    }
}
