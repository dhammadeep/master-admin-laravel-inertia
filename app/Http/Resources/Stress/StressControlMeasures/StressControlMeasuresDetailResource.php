<?php

namespace App\Http\Resources\Stress\StressControlMeasures;

use Illuminate\Http\Resources\Json\JsonResource;

class StressControlMeasuresDetailResource extends JsonResource
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
            'CommodityID' => $this->CommodityID,
            'StressID' => $this->StressID,
            'StressSeverityID' => $this->StressSeverityID,
            'StressControlMeasureID' => $this->StressControlMeasureID,
        ];
    }
}
