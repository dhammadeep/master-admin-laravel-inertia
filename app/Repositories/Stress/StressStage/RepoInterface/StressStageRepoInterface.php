<?php

namespace App\Repositories\Stress\StressStage\RepoInterface;

use App\Http\Requests\Stress\StressStage\StressStageRequest;

interface StressStageRepoInterface
{
    public function add(StressStageRequest $data);

    public function find(string $on = "", string $search = "", int $rowsPerPage = 50);

    public function all(string $on = "", string $search = "");

    public function findById(int $id);

    public function update(StressStageRequest $data, int $id);

    public function getTableFields();

    public function updateStatusReject(array $id);

    public function updateStatusFinalize(array $id);

    public function updateStatusApprove(array $id);
}
