<?php

namespace App\Http\Resources\Regional\Terrain;

use Illuminate\Http\Resources\Json\JsonResource;

class TerrainDetailResource extends JsonResource
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
            'RegionID' => $this->RegionID,
            'TerrainType' => $this->TerrainType,
            'MinPerKm' => $this->MinPerKm,
        ];
    }
}
