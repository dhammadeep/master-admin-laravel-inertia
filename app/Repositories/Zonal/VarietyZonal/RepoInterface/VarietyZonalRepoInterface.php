<?php

namespace App\Repositories\Zonal\VarietyZonal\RepoInterface;

use App\Http\Requests\Zonal\VarietyZonal\VarietyZonalRequest;

interface VarietyZonalRepoInterface
{
    public function add(VarietyZonalRequest $data);

    public function find(string $on = "", string $search = "", int $rowsPerPage = 50);

    public function all(string $on = null, string $search = null);

    public function findById(int $id);

    public function update(VarietyZonalRequest $data,int $id);

    public function getTableFields();

    public function updateStatusReject(array $id);

    public function updateStatusFinalize(array $id);

    public function updateStatusApprove(array $id);

}
