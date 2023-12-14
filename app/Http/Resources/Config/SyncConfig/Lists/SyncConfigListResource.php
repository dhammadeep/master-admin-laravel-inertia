<?php

namespace App\Http\Resources\Config\SyncConfig\Lists;

use Illuminate\Http\Resources\Json\JsonResource;

class SyncConfigListResource extends JsonResource
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
             'Screen' => $this->Screen,
             'Role' => $this->Role,
             'TableName' => $this->TableName,
             'LabelName' => $this->LabelName,
             'ZippingLevel' => $this->ZippingLevel,
        ];
    }
}
