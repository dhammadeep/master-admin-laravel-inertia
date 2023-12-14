<?php

namespace App\Http\Resources\Commodity\HSNCode\Lists;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Commodity\HSNCode\HSNCodeDetailResource;

class HSNCodeListCollection extends ResourceCollection
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
                return new HSNCodeDetailResource($data);
            })->all()
        ];
    }
}
