<?php

namespace App\Http\Resources\Farmer\FarmerInsuranceCompany\Table;

use Illuminate\Http\Resources\Json\JsonResource;

class FarmerInsuranceCompanyTableResource extends JsonResource
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
            'InsuranceTypeName' => $this->FarmerInsuranceType->Name ?? '',
            'Status' => $this->Status,
        ];
    }
}
