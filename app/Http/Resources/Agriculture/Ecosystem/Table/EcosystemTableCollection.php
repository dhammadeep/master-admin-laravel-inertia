<?php

namespace App\Http\Resources\Agriculture\Ecosystem\Table;

use App\Models\Agriculture\Ecosystem;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Agriculture\Ecosystem\Table\EcosystemTableResource;

class EcosystemTableCollection extends ResourceCollection
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
            'columns' => Ecosystem::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new EcosystemTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
