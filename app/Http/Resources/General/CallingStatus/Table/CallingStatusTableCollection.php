<?php

namespace App\Http\Resources\General\CallingStatus\Table;

use App\Models\General\CallingStatus;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\General\CallingStatus\Table\CallingStatusTableResource;

class CallingStatusTableCollection extends ResourceCollection
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
            'columns' => CallingStatus::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new CallingStatusTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
