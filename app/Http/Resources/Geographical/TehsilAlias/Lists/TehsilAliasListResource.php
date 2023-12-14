<?php

namespace App\Http\Resources\Geographical\TehsilAlias\Lists;

use Illuminate\Http\Resources\Json\JsonResource;

class TehsilAliasListResource extends JsonResource
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
            'StateCode' => $this->StateCode,
            'DistrictCode' => $this->DistrictCode,
            'Alias' => $this->Alias,
            'TehsilCode' => $this->TehsilCode,
            'Status' => $this->Status,
        ];
    }
}
