<?php

namespace App\Http\Resources\Stress\StressControlMeasures\Lists;

use Illuminate\Http\Resources\Json\JsonResource;

class StressControlMeasuresListResource extends JsonResource
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
            'CommodityID' => $this->CommodityID,
            'StressID' => $this->StressID,
            'StressSeverityID' => $this->StressSeverityID,
            'StressControlMeasureID' => $this->StressControlMeasureID,
        ];
    }
}
