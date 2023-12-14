<?php

namespace App\Http\Resources\Agrochemicals\AgroCommoditychemical\Table;

use App\Models\Agrochemicals\AgroCommoditychemical;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Agrochemicals\AgroCommoditychemical\Table\AgroCommoditychemicalTableResource;

class AgroCommoditychemicalTableCollection extends ResourceCollection
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
            'columns' => AgroCommoditychemical::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new AgroCommoditychemicalTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
