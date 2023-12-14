<?php

namespace App\Http\Resources\Geographical\TehsilAlias;

use Illuminate\Http\Resources\Json\JsonResource;

class TehsilAliasDetailResource extends JsonResource
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
