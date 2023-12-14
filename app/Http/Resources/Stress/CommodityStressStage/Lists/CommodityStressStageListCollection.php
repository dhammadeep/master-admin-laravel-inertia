<?php

namespace App\Http\Resources\Stress\CommodityStressStage\Lists;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Stress\CommodityStressStage\CommodityStressStageDetailResource;

class CommodityStressStageListCollection extends ResourceCollection
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
            'data' => $this->collection->map(function ($data) {
                return new CommodityStressStageDetailResource($data);
            })->all()
        ];
    }
}
