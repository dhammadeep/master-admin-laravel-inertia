<?php

namespace App\Http\Resources\Stress\Recommendation\Table;

use App\Models\Stress\Recommendation;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Stress\Recommendation\Table\RecommendationTableResource;

class RecommendationTableCollection extends ResourceCollection
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
            'columns' => Recommendation::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new RecommendationTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
