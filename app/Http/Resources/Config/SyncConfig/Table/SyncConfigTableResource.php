<?php

namespace App\Http\Resources\Config\SyncConfig\Table;

use Illuminate\Http\Resources\Json\JsonResource;

class SyncConfigTableResource extends JsonResource
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
            'Screen' => $this->Screen,
            'Name' => $this->Name,
            'Role' => $this->Role,
            'TableName' => $this->TableName,
            'LabelName' => $this->LabelName,
            'ZippingLevel' => $this->ZippingLevel,
            'Status' => $this->Status,
        ];
    }
}
