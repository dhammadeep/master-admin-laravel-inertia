<?php

namespace App\Http\Resources\Farmer\FarmerEnrollmentPlace\Table;

use App\Models\Farmer\FarmerEnrollmentPlace;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Farmer\FarmerEnrollmentPlace\Table\FarmerEnrollmentPlaceTableResource;

class FarmerEnrollmentPlaceTableCollection extends ResourceCollection
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
            'columns' => FarmerEnrollmentPlace::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new FarmerEnrollmentPlaceTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
