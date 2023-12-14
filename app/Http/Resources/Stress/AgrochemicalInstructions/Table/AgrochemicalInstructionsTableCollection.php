<?php

namespace App\Http\Resources\Stress\AgrochemicalInstructions\Table;

use App\Models\Stress\AgrochemicalInstructions;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Stress\AgrochemicalInstructions\Table\AgrochemicalInstructionsTableResource;

class AgrochemicalInstructionsTableCollection extends ResourceCollection
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
            'columns' => AgrochemicalInstructions::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new AgrochemicalInstructionsTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
