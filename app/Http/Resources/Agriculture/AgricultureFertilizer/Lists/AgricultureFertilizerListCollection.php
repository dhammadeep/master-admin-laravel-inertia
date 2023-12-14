<?php

namespace App\Http\Resources\Agriculture\AgricultureFertilizer\Lists;

use App\Http\Resources\Common\Option\OptionResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Agriculture\AgricultureFertilizer\AgricultureFertilizerDetailResource;

class AgricultureFertilizerListCollection extends ResourceCollection
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
            'data' => $this->collection->map(function ($data) {
                return new AgricultureFertilizerDetailResource($data);
            })->all()
        ];
    }
}
