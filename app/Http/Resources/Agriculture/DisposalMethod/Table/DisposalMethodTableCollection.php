<?php

namespace App\Http\Resources\Agriculture\DisposalMethod\Table;

use App\Models\Agriculture\DisposalMethod;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Agriculture\DisposalMethod\Table\DisposalMethodTableResource;

class DisposalMethodTableCollection extends ResourceCollection
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
            'columns' => DisposalMethod::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new DisposalMethodTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
