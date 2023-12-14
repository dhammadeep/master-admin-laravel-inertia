<?php

namespace App\Repositories\Zonal\StandardQuantityChart\RepoInterface;

use App\Http\Requests\Zonal\StandardQuantityChart\StandardQuantityChartRequest;

interface StandardQuantityChartRepoInterface
{
    public function add(StandardQuantityChartRequest $data);

    public function find(string $on = "", string $search = "", int $rowsPerPage = 50);

    public function findById(int $id);

    public function update(StandardQuantityChartRequest $data,int $id);

    public function getTableFields();

    public function updateStatusReject(array $id);

    public function updateStatusFinalize(array $id);

    public function updateStatusApprove(array $id);

}
