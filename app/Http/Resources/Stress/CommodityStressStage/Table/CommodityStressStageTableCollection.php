<?php

namespace App\Http\Resources\Stress\CommodityStressStage\Table;

use App\Models\Stress\CommodityStressStage;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Stress\CommodityStressStage\Table\CommodityStressStageTableResource;

class CommodityStressStageTableCollection extends ResourceCollection
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
            'columns' => CommodityStressStage::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new CommodityStressStageTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
