<?php

namespace App\Repositories\Stress\StressControlMeasures\RepoInterface;

use App\Http\Requests\Stress\StressControlMeasures\StressControlMeasuresRequest;

interface StressControlMeasuresRepoInterface
{
    public function add(StressControlMeasuresRequest $data);

    public function find(string $on = "", string $search = "", int $rowsPerPage = 50);

    public function all(string $on = "", string $search = "");

    public function findById(int $id);

    public function update(StressControlMeasuresRequest $data, int $id);

    public function getTableFields();

    public function updateStatusReject(array $id);

    public function updateStatusFinalize(array $id);

    public function updateStatusApprove(array $id);
}
