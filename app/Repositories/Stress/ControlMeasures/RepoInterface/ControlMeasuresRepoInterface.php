<?php

namespace App\Repositories\Stress\ControlMeasures\RepoInterface;

use App\Http\Requests\Stress\ControlMeasures\ControlMeasuresRequest;

interface ControlMeasuresRepoInterface
{
    public function add(ControlMeasuresRequest $data);

    public function find(string $on = "", string $search = "", int $rowsPerPage = 50);

    public function all(string $on = "", string $search = "");

    public function findById(int $id);

    public function update(ControlMeasuresRequest $data, int $id);

    public function getTableFields();

    public function updateStatusReject(array $id);

    public function updateStatusFinalize(array $id);

    public function updateStatusApprove(array $id);
}
