<?php

namespace App\Http\Resources\Yields\QuantityLossChart\Table;

use Illuminate\Http\Resources\Json\JsonResource;

class QuantityLossChartTableResource extends JsonResource
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
            'PhenophaseName' => $this->phenophase->Name ?? '',
            'StressName' => $this->stress->Name ?? '',
            'MinBandValue' => $this->MinBandValue,
            'MaxBandValue' => $this->MaxBandValue,
            'MinQuantityCorrectionPercent' => $this->MinQuantityCorrectionPercent,
            'MaxQuantityCorrectionPercent' => $this->MaxQuantityCorrectionPercent,
            'Status' => $this->Status,
        ];
    }
}
