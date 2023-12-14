<?php

namespace App\Http\Resources\Yields\QualityChart\Table;

use Illuminate\Http\Resources\Json\JsonResource;

class QualityChartTableResource extends JsonResource
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
            'Name' => $this->Name,
            'CommodityName' => $this->commodity->Name ?? '',
            'PhenophaseName' => $this->phenophase->Name ?? '',
            'HealthParameterName' => $this->healthParameter->Name ?? '',
            'GradeI' => $this->GradeI,
            'GradeII' => $this->GradeII,
            'GradeIII' => $this->GradeIII,
            'MinGradeI' => $this->MinGradeI,
            'MaxGradeI' => $this->MaxGradeI,
            'MinGradeII' => $this->MinGradeII,
            'MaxGradeII' => $this->MaxGradeII,
            'MinGradeIII' => $this->MinGradeIII,
            'MaxGradeIII' => $this->MaxGradeIII,
            'Status' => $this->Status,
        ];
    }
}
