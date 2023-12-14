<?php

namespace App\Repositories\Zonal\StressControl\RepoInterface;

use App\Http\Requests\Zonal\StressControl\StressControlRequest;

interface StressControlRepoInterface
{
    public function add(StressControlRequest $data);

    public function find(string $on = "", string $search = "", int $rowsPerPage = 50);

    public function findById(int $id);

    public function update(StressControlRequest $data,int $id);

    public function getTableFields();

    public function updateStatusReject(array $id);

    public function updateStatusFinalize(array $id);

    public function updateStatusApprove(array $id);

}
