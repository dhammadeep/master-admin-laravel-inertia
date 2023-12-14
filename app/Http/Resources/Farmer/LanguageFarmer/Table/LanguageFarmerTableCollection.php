<?php

namespace App\Http\Resources\Farmer\LanguageFarmer\Table;

use App\Models\Farmer\LanguageFarmer;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Farmer\LanguageFarmer\Table\LanguageFarmerTableResource;

class LanguageFarmerTableCollection extends ResourceCollection
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
            'columns' => LanguageFarmer::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new LanguageFarmerTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
