<?php

namespace App\Http\Resources\Config\SyncConfig\Table;

use App\Models\Config\SyncConfig;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Config\SyncConfig\Table\SyncConfigTableResource;

class SyncConfigTableCollection extends ResourceCollection
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
            'columns' => SyncConfig::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new SyncConfigTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
