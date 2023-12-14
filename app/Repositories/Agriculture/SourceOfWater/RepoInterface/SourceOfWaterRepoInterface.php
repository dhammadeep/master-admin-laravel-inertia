<?php

namespace App\Repositories\Agriculture\SourceOfWater\RepoInterface;

use App\Http\Requests\Agriculture\SourceOfWater\SourceOfWaterRequest;

interface SourceOfWaterRepoInterface
{
    public function add(SourceOfWaterRequest $data);

    public function find(string $on = "", string $search = "", int $rowsPerPage = 50);

    public function findById(int $id);

    public function update(SourceOfWaterRequest $data, int $id);

    public function getTableFields();

    public function updateStatusReject(array $id);

    public function updateStatusFinalize(array $id);

    public function updateStatusApprove(array $id);
}
