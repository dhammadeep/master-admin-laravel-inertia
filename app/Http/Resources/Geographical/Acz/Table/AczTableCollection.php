<?php

namespace App\Http\Resources\Geographical\Acz\Table;

use App\Models\Geographical\Acz;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Geographical\Acz\Table\AczTableResource;

class AczTableCollection extends ResourceCollection
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
            'columns' => Acz::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new AczTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
