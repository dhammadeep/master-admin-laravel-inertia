<?php

namespace App\Http\Resources\Commodity\QualityParameter\Table;

use App\Models\Commodity\QualityParameter;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Commodity\QualityParameter\Table\QualityParameterTableResource;

class QualityParameterTableCollection extends ResourceCollection
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
            'columns' => QualityParameter::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new QualityParameterTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
