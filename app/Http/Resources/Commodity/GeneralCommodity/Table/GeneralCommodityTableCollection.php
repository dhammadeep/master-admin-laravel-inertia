<?php

namespace App\Http\Resources\Commodity\GeneralCommodity\Table;

use App\Models\Commodity\GeneralCommodity;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Commodity\GeneralCommodity\Table\GeneralCommodityTableResource;

class GeneralCommodityTableCollection extends ResourceCollection
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
            'columns' => GeneralCommodity::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new GeneralCommodityTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
