<?php

namespace App\Http\Resources\Geographical\DistrictAlias\Table;

use Illuminate\Http\Resources\Json\JsonResource;

class DistrictAliasTableResource extends JsonResource
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
            'Alias' => $this->Alias
        ];
    }
}
