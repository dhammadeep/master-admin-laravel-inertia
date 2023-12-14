<?php

namespace App\Repositories\Zonal\VarietyQuality\RepoInterface;

use App\Http\Requests\Zonal\VarietyQuality\VarietyQualityRequest;

interface VarietyQualityRepoInterface
{
    public function add(VarietyQualityRequest $data);

    public function find(string $on = "", string $search = "", int $rowsPerPage = 50);

    public function findById(int $id);

    public function update(VarietyQualityRequest $data,int $id);

    public function getTableFields();

    public function updateStatusReject(array $id);

    public function updateStatusFinalize(array $id);

    public function updateStatusApprove(array $id);

}
