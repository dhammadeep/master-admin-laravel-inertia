<?php

namespace App\Repositories\Commodity\CommodityClass\RepoInterface;

use App\Http\Requests\Commodity\CommodityClass\CommodityClassRequest;

interface CommodityClassRepoInterface
{
    public function add(CommodityClassRequest $data);

    public function find(string $on = "", string $search = "", int $rowsPerPage = 50);

    public function all(string $on = "", string $search = "");

    public function findById(int $id);

    public function update(CommodityClassRequest $data,int $id);

    public function getTableFields();

    public function updateStatusReject(array $id);

    public function updateStatusFinalize(array $id);

    public function updateStatusApprove(array $id);

}
