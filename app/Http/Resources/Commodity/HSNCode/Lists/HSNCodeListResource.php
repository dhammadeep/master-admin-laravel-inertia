<?php

namespace App\Http\Resources\Commodity\HSNCode\Lists;

use Illuminate\Http\Resources\Json\JsonResource;

class HSNCodeListResource extends JsonResource
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
             'GeneralCommodityID' => $this->GeneralCommodityID,
             'CommodityClassID' => $this->CommodityClassID,
             'HSCode' => $this->HSCode,
             'UomID' => $this->UomID,
             'Description' => $this->Description,
        ];
    }
}
