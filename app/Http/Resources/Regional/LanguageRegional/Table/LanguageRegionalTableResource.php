<?php

namespace App\Http\Resources\Regional\LanguageRegional\Table;

use Illuminate\Http\Resources\Json\JsonResource;

class LanguageRegionalTableResource extends JsonResource
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
            'StateName' => $this->State->Name,
            'LanguageName' => $this->Language->Name,
            'Status' => $this->Status,
        ];
    }
}
