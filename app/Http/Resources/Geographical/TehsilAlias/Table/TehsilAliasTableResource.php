<?php

namespace App\Http\Resources\Geographical\TehsilAlias\Table;

use Illuminate\Http\Resources\Json\JsonResource;

class TehsilAliasTableResource extends JsonResource
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
            'StateName' => $this->State->Name ?? '',
            'DistrictName' => $this->District->Name ?? '',
            'Alias' => $this->Alias,
            'TehsilName' => $this->Tehsil->Name ?? '',
            'Status' => $this->Status,
        ];
    }
}
