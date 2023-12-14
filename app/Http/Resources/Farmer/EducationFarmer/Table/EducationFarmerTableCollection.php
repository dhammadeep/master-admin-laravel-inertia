<?php

namespace App\Http\Resources\Farmer\EducationFarmer\Table;

use App\Models\Farmer\EducationFarmer;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Farmer\EducationFarmer\Table\EducationFarmerTableResource;

class EducationFarmerTableCollection extends ResourceCollection
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
            'columns' => EducationFarmer::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new EducationFarmerTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
