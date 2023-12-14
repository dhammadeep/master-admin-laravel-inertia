<?php

namespace App\Http\Resources\Agriculture\Band\Table;

use App\Models\Agriculture\Band;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Agriculture\Band\Table\BandTableResource;

class BandTableCollection extends ResourceCollection
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
            'columns' => Band::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new BandTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
