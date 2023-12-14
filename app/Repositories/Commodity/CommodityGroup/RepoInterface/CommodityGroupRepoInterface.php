<?php

namespace App\Repositories\Commodity\CommodityGroup\RepoInterface;

use App\Http\Requests\Commodity\CommodityGroup\CommodityGroupRequest;

interface CommodityGroupRepoInterface
{
    public function add(CommodityGroupRequest $data);

    public function find(string $on = "", string $search = "", int $rowsPerPage = 50);

    public function all(string $on = "", string $search = "");

    public function findById(int $id);

    public function update(CommodityGroupRequest $data,int $id);

    public function getTableFields();

    public function updateStatusReject(array $id);

    public function updateStatusFinalize(array $id);

    public function updateStatusApprove(array $id);

}
