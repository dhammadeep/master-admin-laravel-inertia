<?php

namespace App\Http\Resources\Farmer\FarmerProxyRelationType\Table;

use App\Models\Farmer\FarmerProxyRelationType;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Farmer\FarmerProxyRelationType\Table\FarmerProxyRelationTypeTableResource;

class FarmerProxyRelationTypeTableCollection extends ResourceCollection
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
            'columns' => FarmerProxyRelationType::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new FarmerProxyRelationTypeTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
