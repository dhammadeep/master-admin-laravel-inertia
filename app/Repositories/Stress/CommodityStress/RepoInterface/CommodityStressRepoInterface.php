<?php

namespace App\Repositories\Stress\CommodityStress\RepoInterface;

use App\Http\Requests\Stress\CommodityStress\CommodityStressRequest;

interface CommodityStressRepoInterface
{
    public function add(CommodityStressRequest $data);

    public function find(string $on = "", string $search = "", int $rowsPerPage = 50);

    public function findById(int $id);

    public function update(CommodityStressRequest $data, int $id);

    public function getTableFields();

    public function updateStatusReject(array $id);

    public function updateStatusFinalize(array $id);

    public function updateStatusApprove(array $id);
}
