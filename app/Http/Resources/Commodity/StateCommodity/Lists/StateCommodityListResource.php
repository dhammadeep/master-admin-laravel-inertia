<?php

namespace App\Http\Resources\Commodity\StateCommodity\Lists;

use Illuminate\Http\Resources\Json\JsonResource;

class StateCommodityListResource extends JsonResource
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
             'StateCode' => $this->StateCode,
             'CommodityID' => $this->CommodityID
        ];
    }
}
