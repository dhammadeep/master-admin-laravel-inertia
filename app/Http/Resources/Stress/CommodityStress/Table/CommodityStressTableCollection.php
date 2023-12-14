<?php

namespace App\Http\Resources\Stress\CommodityStress\Table;

use App\Models\Stress\CommodityStress;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Stress\CommodityStress\Table\CommodityStressTableResource;

class CommodityStressTableCollection extends ResourceCollection
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
            'columns' => CommodityStress::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new CommodityStressTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
