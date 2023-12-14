<?php

namespace App\Http\Resources\Farmer\FarmerGovtOfficialDesignation\Lists;

use Illuminate\Http\Resources\Json\JsonResource;

class FarmerGovtOfficialDesignationListResource extends JsonResource
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
             'DepartmentID' => $this->DepartmentID,
             'Name' => $this->Name,
        ];
    }
}
