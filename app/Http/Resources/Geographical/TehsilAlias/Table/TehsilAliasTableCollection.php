<?php

namespace App\Http\Resources\Geographical\TehsilAlias\Table;

use App\Models\Geographical\TehsilAlias;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Geographical\TehsilAlias\Table\TehsilAliasTableResource;

class TehsilAliasTableCollection extends ResourceCollection
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
            'columns' => TehsilAlias::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new TehsilAliasTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
