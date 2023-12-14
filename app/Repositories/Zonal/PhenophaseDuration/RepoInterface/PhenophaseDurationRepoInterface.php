<?php

namespace App\Repositories\Zonal\PhenophaseDuration\RepoInterface;

use App\Http\Requests\Zonal\PhenophaseDuration\PhenophaseDurationRequest;

interface PhenophaseDurationRepoInterface
{
    public function add(PhenophaseDurationRequest $data);

    public function find(string $on = "", string $search = "", int $rowsPerPage = 50);

    public function findById(int $id);

    public function update(PhenophaseDurationRequest $data,int $id);

    public function getTableFields();

    public function updateStatusReject(array $id);

    public function updateStatusFinalize(array $id);

    public function updateStatusApprove(array $id);

}
