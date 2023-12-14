<?php

namespace App\Http\Resources\Farmer\FarmerValidateStress\Table;

use App\Models\Farmer\FarmerValidateStress;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Farmer\FarmerValidateStress\Table\FarmerValidateStressTableResource;

class FarmerValidateStressTableCollection extends ResourceCollection
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
            'columns' => FarmerValidateStress::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new FarmerValidateStressTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
