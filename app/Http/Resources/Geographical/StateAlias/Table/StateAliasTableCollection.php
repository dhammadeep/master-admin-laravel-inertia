<?php

namespace App\Http\Resources\Geographical\StateAlias\Table;

use App\Models\Geographical\StateAlias;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Geographical\StateAlias\Table\StateAliasTableResource;

class StateAliasTableCollection extends ResourceCollection
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
            'columns' => StateAlias::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new StateAliasTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
