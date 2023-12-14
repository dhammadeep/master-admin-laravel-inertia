<?php

namespace App\Http\Resources\Farmer\FarmerMaritalStatus\Table;

use App\Models\Farmer\FarmerMaritalStatus;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Farmer\FarmerMaritalStatus\Table\FarmerMaritalStatusTableResource;

class FarmerMaritalStatusTableCollection extends ResourceCollection
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
            'columns' => FarmerMaritalStatus::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new FarmerMaritalStatusTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
