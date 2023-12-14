<?php

namespace App\Http\Resources\General\DropReason\Table;

use App\Models\General\DropReason;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\General\DropReason\Table\DropReasonTableResource;

class DropReasonTableCollection extends ResourceCollection
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
            'columns' => DropReason::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new DropReasonTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
