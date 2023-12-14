<?php

namespace App\Http\Resources\Regional\Terrain\Lists;

use Illuminate\Http\Resources\Json\JsonResource;

class TerrainListResource extends JsonResource
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
             'TerrainType' => $this->TerrainType,
             'MinPerKm' => $this->MinPerKm,
        ];
    }
}
