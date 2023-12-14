<?php

namespace App\Http\Resources\Agriculture\AlliedActivity\Table;

use App\Models\Agriculture\AlliedActivity;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Agriculture\AlliedActivity\Table\AlliedActivityTableResource;

class AlliedActivityTableCollection extends ResourceCollection
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
            'columns' => AlliedActivity::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new AlliedActivityTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
