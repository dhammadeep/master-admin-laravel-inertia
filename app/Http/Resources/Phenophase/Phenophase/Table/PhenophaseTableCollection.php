<?php

namespace App\Http\Resources\Phenophase\Phenophase\Table;

use App\Models\Phenophase\Phenophase;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Phenophase\Phenophase\Table\PhenophaseTableResource;

class PhenophaseTableCollection extends ResourceCollection
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
            'columns' => Phenophase::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new PhenophaseTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
