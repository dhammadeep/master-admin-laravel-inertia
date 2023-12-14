<?php

namespace App\Http\Resources\Commodity\CommodityAlias;

use Illuminate\Http\Resources\Json\JsonResource;

class CommodityAliasDetailResource extends JsonResource
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
            'Alias' => $this->Alias
        ];
    }
}
