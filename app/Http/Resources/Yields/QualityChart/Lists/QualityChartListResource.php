<?php

namespace App\Http\Resources\Yields\QualityChart\Lists;

use Illuminate\Http\Resources\Json\JsonResource;

class QualityChartListResource extends JsonResource
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
            'CommodityID' => $this->CommodityID,
            'PhenophaseID' => $this->PhenophaseID,
            'HealthParameterID' => $this->HealthParameterID,
            'GradeI' => $this->GradeI,
            'GradeII' => $this->GradeII,
            'GradeIII' => $this->GradeIII,
            'MinGradeI' => $this->MinGradeI,
            'MaxGradeI' => $this->MaxGradeI,
            'MinGradeII' => $this->MinGradeII,
            'MaxGradeII' => $this->MaxGradeII,
            'MinGradeIII' => $this->MinGradeIII,
            'MaxGradeIII' => $this->MaxGradeIII,
        ];
    }
}
