<?php

namespace App\Http\Resources\Geographical\VillageAlias\Table;

use App\Models\Geographical\VillageAlias;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Geographical\VillageAlias\Table\VillageAliasTableResource;

class VillageAliasTableCollection extends ResourceCollection
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
            'columns' => VillageAlias::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new VillageAliasTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
