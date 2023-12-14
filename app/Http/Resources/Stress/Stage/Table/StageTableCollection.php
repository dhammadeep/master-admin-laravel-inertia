<?php

namespace App\Http\Resources\Stress\Stage\Table;

use App\Models\Stress\Stage;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Stress\Stage\Table\StageTableResource;

class StageTableCollection extends ResourceCollection
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
            'columns' => Stage::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new StageTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
