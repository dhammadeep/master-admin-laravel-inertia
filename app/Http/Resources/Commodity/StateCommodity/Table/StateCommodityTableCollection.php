<?php

namespace App\Http\Resources\Commodity\StateCommodity\Table;

use App\Models\Commodity\StateCommodity;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Commodity\StateCommodity\Table\StateCommodityTableResource;

class StateCommodityTableCollection extends ResourceCollection
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
            'columns' => StateCommodity::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new StateCommodityTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
