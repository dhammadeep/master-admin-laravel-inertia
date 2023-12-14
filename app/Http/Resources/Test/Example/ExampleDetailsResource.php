<?php

namespace App\Http\Resources\Test\Example;

use Illuminate\Http\Resources\Json\JsonResource;

class ExampleDetailsResource extends JsonResource
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
            'ID' => $this->ID,
            'AboutMe' => $this->AboutMe,
            'ProfilePhoto' => $this->ProfilePhoto,
            'Gender' => $this->Gender
        ]
    }
}
