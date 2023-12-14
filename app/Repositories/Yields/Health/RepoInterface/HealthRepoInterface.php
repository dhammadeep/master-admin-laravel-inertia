<?php

namespace App\Repositories\Yields\Health\RepoInterface;

use App\Http\Requests\Yields\Health\HealthRequest;

interface HealthRepoInterface
{
    public function add(HealthRequest $data);

    public function find(string $on = "", string $search = "", int $rowsPerPage = 50);

    public function all(string $on = "", string $search = "");

    public function findById(int $id);

    public function update(HealthRequest $data, int $id);

    public function getTableFields();

    public function updateStatusReject(array $id);

    public function updateStatusFinalize(array $id);

    public function updateStatusApprove(array $id);
}
