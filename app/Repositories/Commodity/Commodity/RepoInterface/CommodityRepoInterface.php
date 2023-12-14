<?php

namespace App\Repositories\Commodity\Commodity\RepoInterface;

use App\Http\Requests\Commodity\Commodity\CommodityRequest;

interface CommodityRepoInterface
{
    public function add(string $fileUrl,CommodityRequest $data);

    public function find(string $on = "", string $search = "", int $rowsPerPage = 50);

    public function all(string $on = "", string $search = "");

    public function findById(int $id);

    public function update(CommodityRequest $data,int $id);

    public function getTableFields();

    public function updateStatusReject(array $id);

    public function updateStatusFinalize(array $id);

    public function updateStatusApprove(array $id);

}
