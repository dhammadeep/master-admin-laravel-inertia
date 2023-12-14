<?php

namespace App\Http\Resources\Regional\Terrain\Table;

use Illuminate\Http\Resources\Json\JsonResource;

class TerrainTableResource extends JsonResource
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
            'TerrainType' => $this->TerrainType,
            'MinPerKm' => $this->MinPerKm,
            'Status' => $this->Status,
        ];
    }
}
