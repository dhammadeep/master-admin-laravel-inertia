<?php

namespace App\Repositories\Zonal\CommodityCultivationCost\RepoInterface;

use App\Http\Requests\Zonal\CommodityCultivationCost\CommodityCultivationCostRequest;

interface CommodityCultivationCostRepoInterface
{
    public function add(CommodityCultivationCostRequest $data);

    public function find(string $on = "", string $search = "", int $rowsPerPage = 50);

    public function findById(int $id);

    public function update(CommodityCultivationCostRequest $data,int $id);

    public function getTableFields();

    public function updateStatusReject(array $id);

    public function updateStatusFinalize(array $id);

    public function updateStatusApprove(array $id);

}
