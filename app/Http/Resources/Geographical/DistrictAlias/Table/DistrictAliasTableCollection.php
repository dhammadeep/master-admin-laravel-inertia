<?php

namespace App\Http\Resources\Geographical\DistrictAlias\Table;

use App\Models\Geographical\DistrictAlias;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Geographical\DistrictAlias\Table\DistrictAliasTableResource;

class DistrictAliasTableCollection extends ResourceCollection
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
            'columns' => DistrictAlias::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new DistrictAliasTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
