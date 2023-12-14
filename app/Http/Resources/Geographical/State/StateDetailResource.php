<?php

namespace App\Http\Resources\Geographical\State;

use Illuminate\Http\Resources\Json\JsonResource;

class StateDetailResource extends JsonResource
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
             'CountryCode' => $this->CountryCode,
             'StateCode' => $this->StateCode,
             'Name' => $this->Name,
        ];
    }
}
