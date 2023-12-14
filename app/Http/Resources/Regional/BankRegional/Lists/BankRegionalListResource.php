<?php

namespace App\Http\Resources\Regional\BankRegional\Lists;

use Illuminate\Http\Resources\Json\JsonResource;

class BankRegionalListResource extends JsonResource
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
             'StateCode' => $this->StateCode,
             'BankID' => $this->BankID,
        ];
    }
}
