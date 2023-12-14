<?php

namespace App\Http\Resources\Commodity\CommodityGroup;

use Illuminate\Http\Resources\Json\JsonResource;

class CommodityGroupDetailResource extends JsonResource
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
            'Name' => $this->Name,
            'ViewOrder' => $this->ViewOrder
        ];
    }
}
