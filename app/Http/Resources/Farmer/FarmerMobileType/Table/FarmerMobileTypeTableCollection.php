<?php

namespace App\Http\Resources\Farmer\FarmerMobileType\Table;

use App\Models\Farmer\FarmerMobileType;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Farmer\FarmerMobileType\Table\FarmerMobileTypeTableResource;

class FarmerMobileTypeTableCollection extends ResourceCollection
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
            'columns' => FarmerMobileType::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new FarmerMobileTypeTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
