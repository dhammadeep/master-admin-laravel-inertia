<?php

namespace App\Http\Resources\Farmer\FarmerInsuranceCompany\Table;

use App\Models\Farmer\FarmerInsuranceCompany;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Farmer\FarmerInsuranceCompany\Table\FarmerInsuranceCompanyTableResource;

class FarmerInsuranceCompanyTableCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'columns' => FarmerInsuranceCompany::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new FarmerInsuranceCompanyTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
