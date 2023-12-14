<?php

namespace App\Repositories\Stress\Stress\RepoInterface;

use App\Http\Requests\Stress\Stress\StressRequest;

interface StressRepoInterface
{
    public function add(StressRequest $data);

    public function find(string $on = "", string $search = "", int $rowsPerPage = 50);

    public function all(string $on = "", string $search = "");

    public function findById(int $id);

    public function update(StressRequest $data,int $id);

    public function getTableFields();

    public function updateStatusReject(array $id);

    public function updateStatusFinalize(array $id);

    public function updateStatusApprove(array $id);

}
