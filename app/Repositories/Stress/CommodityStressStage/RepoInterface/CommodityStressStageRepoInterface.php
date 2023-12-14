<?php

namespace App\Repositories\Stress\CommodityStressStage\RepoInterface;

use App\Http\Requests\Stress\CommodityStressStage\CommodityStressStageRequest;

interface CommodityStressStageRepoInterface
{
    public function add(CommodityStressStageRequest $data);

    public function find(string $on = "", string $search = "", int $rowsPerPage = 50);

    public function findById(int $id);

    public function update(CommodityStressStageRequest $data, int $id);

    public function getTableFields();

    public function updateStatusReject(array $id);

    public function updateStatusFinalize(array $id);

    public function updateStatusApprove(array $id);
}
