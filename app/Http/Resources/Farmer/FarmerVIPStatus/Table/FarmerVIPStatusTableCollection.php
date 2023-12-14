<?php

namespace App\Http\Resources\Farmer\FarmerVIPStatus\Table;

use App\Models\Farmer\FarmerVIPStatus;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Farmer\FarmerVIPStatus\Table\FarmerVIPStatusTableResource;

class FarmerVIPStatusTableCollection extends ResourceCollection
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
            'columns' => FarmerVIPStatus::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new FarmerVIPStatusTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
