<?php

namespace App\Http\Resources\Stress\SeedTreatment\Table;

use App\Models\Stress\SeedTreatment;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Stress\SeedTreatment\Table\SeedTreatmentTableResource;

class SeedTreatmentTableCollection extends ResourceCollection
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
            'columns' => SeedTreatment::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new SeedTreatmentTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
