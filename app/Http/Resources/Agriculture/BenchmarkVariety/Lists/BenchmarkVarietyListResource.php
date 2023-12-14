<?php

namespace App\Http\Resources\Agriculture\BenchmarkVariety\Lists;

use Illuminate\Http\Resources\Json\JsonResource;

class BenchmarkVarietyListResource extends JsonResource
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
            'RegionID' => $this->RegionID,
            'StateCode' => $this->StateCode,
            'SeasonID' => $this->SeasonID,
            'CommodityID' => $this->CommodityID,
            'VarietyID' => $this->VarietyID,
            'IsDrkBenchmark' => $this->IsDrkBenchmark,
            'IsAgmBenchmark' => $this->IsAgmBenchmark,
        ];
    }
}
