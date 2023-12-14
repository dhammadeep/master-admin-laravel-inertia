<?php

namespace App\Repositories\Stress\DoseFactor\RepoInterface;

use App\Http\Requests\Stress\DoseFactor\DoseFactorRequest;

interface DoseFactorRepoInterface
{
    public function add(DoseFactorRequest $data);

    public function find(string $on = "", string $search = "", int $rowsPerPage = 50);

    public function findById(int $id);

    public function update(DoseFactorRequest $data, int $id);

    public function getTableFields();

    public function updateStatusReject(array $id);

    public function updateStatusFinalize(array $id);

    public function updateStatusApprove(array $id);
}
