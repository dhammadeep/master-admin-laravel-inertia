<?php

namespace App\Http\Resources\Farmer\FarmerGovtOfficialDesignation\Table;

use Illuminate\Http\Resources\Json\JsonResource;

class FarmerGovtOfficialDesignationTableResource extends JsonResource
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
            'DepartmentName' => $this->FarmerGovtDepartment->Name ?? '',
            'Name' => $this->Name,
            'Status' => $this->Status
        ];
    }
}
