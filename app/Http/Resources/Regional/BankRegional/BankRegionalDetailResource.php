<?php

namespace App\Http\Resources\Regional\BankRegional;

use Illuminate\Http\Resources\Json\JsonResource;

class BankRegionalDetailResource extends JsonResource
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
            'BankID' => $this->BankID,
        ];
    }
}
