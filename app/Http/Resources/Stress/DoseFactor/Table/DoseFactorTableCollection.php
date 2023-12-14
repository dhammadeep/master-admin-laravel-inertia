<?php

namespace App\Http\Resources\Stress\DoseFactor\Table;

use App\Models\Stress\DoseFactor;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Stress\DoseFactor\Table\DoseFactorTableResource;

class DoseFactorTableCollection extends ResourceCollection
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
            'columns' => DoseFactor::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new DoseFactorTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
