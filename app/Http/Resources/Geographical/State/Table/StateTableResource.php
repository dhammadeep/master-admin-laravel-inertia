<?php

namespace App\Http\Resources\Geographical\State\Table;

use Illuminate\Http\Resources\Json\JsonResource;

class StateTableResource extends JsonResource
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
             'CountryName' => $this->Country->Name ?? '',
             'StateCode' => $this->StateCode,
             'Name' => $this->Name,
            'Status' => $this->Status,
        ];
    }
}
