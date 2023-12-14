<?php

namespace App\Http\Resources\General\Company\Table;

use Illuminate\Http\Resources\Json\JsonResource;

class CompanyTableResource extends JsonResource
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
            'Description' => $this->Description,
            'Status' => $this->Status,
        ];
    }
}
