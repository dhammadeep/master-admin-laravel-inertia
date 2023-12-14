<?php

namespace App\Repositories\Zonal\StressDuration\RepoInterface;

use App\Http\Requests\Zonal\StressDuration\StressDurationRequest;

interface StressDurationRepoInterface
{
    public function add(StressDurationRequest $data);

    public function find(string $on = "", string $search = "", int $rowsPerPage = 50);

    public function findById(int $id);

    public function update(StressDurationRequest $data,int $id);

    public function getTableFields();

    public function updateStatusReject(array $id);

    public function updateStatusFinalize(array $id);

    public function updateStatusApprove(array $id);

}
