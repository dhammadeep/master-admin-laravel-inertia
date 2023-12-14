<?php

namespace App\Repositories\Stress\Stage\RepoInterface;

use App\Http\Requests\Stress\Stage\StageRequest;

interface StageRepoInterface
{
    public function add(StageRequest $data);

    public function find(string $on = "", string $search = "", int $rowsPerPage = 50);

    public function all(string $on = "", string $search = "");

    public function findById(int $id);

    public function update(StageRequest $data, int $id);

    public function getTableFields();

    public function updateStatusReject(array $id);

    public function updateStatusFinalize(array $id);

    public function updateStatusApprove(array $id);
}
