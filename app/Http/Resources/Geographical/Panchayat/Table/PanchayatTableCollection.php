<?php

namespace App\Http\Resources\Geographical\Panchayat\Table;

use App\Models\Geographical\Panchayat;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Geographical\Panchayat\Table\PanchayatTableResource;

class PanchayatTableCollection extends ResourceCollection
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
            'columns' => Panchayat::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new PanchayatTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
