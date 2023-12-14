<?php

namespace App\Http\Resources\Regional\LanguageRegional\Table;

use App\Models\Regional\LanguageRegional;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Regional\LanguageRegional\Table\LanguageRegionalTableResource;

class LanguageRegionalTableCollection extends ResourceCollection
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
            'columns' => LanguageRegional::getTableFields(),
            'data' => $this->collection->map(function ($data) {
                return new LanguageRegionalTableResource($data);
            })->all(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
