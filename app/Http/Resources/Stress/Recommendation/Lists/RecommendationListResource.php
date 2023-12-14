<?php

namespace App\Http\Resources\Stress\Recommendation\Lists;

use Illuminate\Http\Resources\Json\JsonResource;

class RecommendationListResource extends JsonResource
{
     /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
         return [
             'Name' => $this->Name,
        ];
    }
}
