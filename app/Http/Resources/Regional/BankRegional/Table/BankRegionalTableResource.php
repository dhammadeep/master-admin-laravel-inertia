<?php

namespace App\Http\Resources\Regional\BankRegional\Table;

use Illuminate\Http\Resources\Json\JsonResource;

class BankRegionalTableResource extends JsonResource
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
            'BankName' => $this->Bank->Name ?? '',
            'Status' => $this->Status,
        ];
    }
}
