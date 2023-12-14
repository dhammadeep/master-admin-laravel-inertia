<?php

namespace App\Http\Resources\Farmer\FarmerGovtOfficialDesignation\Table;

use App\Models\Farmer\FarmerGovtOfficialDesignation;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Farmer\FarmerGovtOfficialDesignation\Table\FarmerGovtOfficialDesignationTableResource;

class FarmerGovtOfficialDesignationTableCollection extends ResourceCollection
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
            'columns' => FarmerGovtOfficialDesignation::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new FarmerGovtOfficialDesignationTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
