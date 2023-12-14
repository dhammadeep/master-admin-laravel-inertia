<?php

namespace App\Repositories\Yields\QuantityLossChart\RepoInterface;

use App\Http\Requests\Yields\QuantityLossChart\QuantityLossChartRequest;

interface QuantityLossChartRepoInterface
{
    public function add(QuantityLossChartRequest $data);

    public function find(string $on = "", string $search = "", int $rowsPerPage = 50);

    public function findById(int $id);

    public function update(QuantityLossChartRequest $data,int $id);

    public function getTableFields();

    public function updateStatusReject(array $id);

    public function updateStatusFinalize(array $id);

    public function updateStatusApprove(array $id);

}
