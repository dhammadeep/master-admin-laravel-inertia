<?php

namespace App\Http\Resources\Agriculture\BenchmarkVariety\Table;

use Illuminate\Http\Resources\Json\JsonResource;

class BenchmarkVarietyTableResource extends JsonResource
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
            'RegionName' => $this->Region->Name ?? '',
            'StateName' => $this->State->Name ?? '',
            'SeasonName' => $this->Season->Name ?? '',
            'CommodityName' => $this->Commodity->Name ?? '',
            'VarietyName' => $this->Variety->Name ?? '',
            'IsDrkBenchmark' => $this->IsDrkBenchmark,
            'IsAgmBenchmark' => $this->IsAgmBenchmark,
            'Status' => $this->Status
        ];
    }
}
