<?php

namespace App\Http\Resources\Commodity\GeneralCommodity\Lists;

use Illuminate\Http\Resources\Json\JsonResource;

class GeneralCommodityListResource extends JsonResource
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
        ];
    }
}
