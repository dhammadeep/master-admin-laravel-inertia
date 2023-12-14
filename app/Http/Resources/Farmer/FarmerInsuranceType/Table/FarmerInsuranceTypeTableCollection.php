<?php

namespace App\Http\Resources\Farmer\FarmerInsuranceType\Table;

use App\Models\Farmer\FarmerInsuranceType;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Farmer\FarmerInsuranceType\Table\FarmerInsuranceTypeTableResource;

class FarmerInsuranceTypeTableCollection extends ResourceCollection
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
            'columns' => FarmerInsuranceType::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new FarmerInsuranceTypeTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
