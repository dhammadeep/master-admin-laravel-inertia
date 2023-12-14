<?php

namespace App\Http\Resources\Geographical\State\Table;

use App\Models\Geographical\State;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Geographical\State\Table\StateTableResource;

class StateTableCollection extends ResourceCollection
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
            'columns' => State::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new StateTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
