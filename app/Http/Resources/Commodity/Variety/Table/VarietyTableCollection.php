<?php

namespace App\Http\Resources\Commodity\Variety\Table;

use App\Models\Commodity\Variety;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Commodity\Variety\Table\VarietyTableResource;

class VarietyTableCollection extends ResourceCollection
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
            'columns' => Variety::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new VarietyTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
