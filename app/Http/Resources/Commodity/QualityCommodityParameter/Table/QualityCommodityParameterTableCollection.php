<?php

namespace App\Http\Resources\Commodity\QualityCommodityParameter\Table;

use App\Models\Commodity\QualityCommodityParameter;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Commodity\QualityCommodityParameter\Table\QualityCommodityParameterTableResource;

class QualityCommodityParameterTableCollection extends ResourceCollection
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
            'columns' => QualityCommodityParameter::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new QualityCommodityParameterTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
