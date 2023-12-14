<?php

namespace App\Http\Resources\Geographical\StateAlias\Table;

use Illuminate\Http\Resources\Json\JsonResource;

class StateAliasTableResource extends JsonResource
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
            'StateName' => $this->State->Name ?? '',
            'Alias' => $this->Alias,
            'Status' => $this->Status
        ];
    }
}
