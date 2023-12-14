<?php

namespace App\Http\Resources\Commodity\CommodityGroup\Lists;

use Illuminate\Http\Resources\Json\JsonResource;

class CommodityGroupListResource extends JsonResource
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
             'Name' => $this->Name,
             'ViewOrder' => $this->ViewOrder
        ];
    }
}
