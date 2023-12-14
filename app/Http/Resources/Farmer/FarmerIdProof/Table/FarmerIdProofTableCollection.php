<?php

namespace App\Http\Resources\Farmer\FarmerIdProof\Table;

use App\Models\Farmer\FarmerIdProof;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Farmer\FarmerIdProof\Table\FarmerIdProofTableResource;

class FarmerIdProofTableCollection extends ResourceCollection
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
            'columns' => FarmerIdProof::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new FarmerIdProofTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
