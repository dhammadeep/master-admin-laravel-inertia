<?php

namespace App\Http\Resources\Yields\QuantityLossChart\Lists;

use Illuminate\Http\Resources\Json\JsonResource;

class QuantityLossChartListResource extends JsonResource
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
            'PhenophaseID' => $this->PhenophaseID,
            'MinBandValue' => $this->MinBandValue,
            'MaxBandValue' => $this->MaxBandValue,
            'MinQuantityCorrectionPercent' => $this->MinQuantityCorrectionPercent,
            'MaxQuantityCorrectionPercent' => $this->MaxQuantityCorrectionPercent,
        ];
    }
}
