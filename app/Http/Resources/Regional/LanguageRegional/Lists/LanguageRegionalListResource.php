<?php

namespace App\Http\Resources\Regional\LanguageRegional\Lists;

use Illuminate\Http\Resources\Json\JsonResource;

class LanguageRegionalListResource extends JsonResource
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
             'LanguageID' => $this->LanguageID,
        ];
    }
}
