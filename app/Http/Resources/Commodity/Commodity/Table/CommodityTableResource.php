<?php

namespace App\Http\Resources\Commodity\Commodity\Table;

use Illuminate\Support\Str;
use Illuminate\Http\Resources\Json\JsonResource;

class CommodityTableResource extends JsonResource
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
            'Name' => $this->Name ?? '',
            'ScientificName' => $this->ScientificName ?? '',
            'CommodityGroupName' => $this->CommodityGroup->Name ?? '',
            'CommodityGroupIndex' => $this->CommodityGroupIndex ?? '',
            'Logo' => Str::replace('images/', 'thumbnails/', $this->Logo),
            'Status' => $this->Status ?? ''
        ];
    }
}
