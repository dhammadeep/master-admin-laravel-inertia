<?php

namespace App\Repositories\Commodity\CommodityAlias\RepoInterface;

use App\Http\Requests\Commodity\CommodityAlias\CommodityAliasRequest;

interface CommodityAliasRepoInterface
{
    public function add(CommodityAliasRequest $data);

    public function find(string $on = "", string $search = "", int $rowsPerPage = 50);

    public function all(string $on = "", string $search = "");

    public function findById(int $id);

    public function update(CommodityAliasRequest $data,int $id);

    public function getTableFields();

    public function updateStatusReject(array $id);

    public function updateStatusFinalize(array $id);

    public function updateStatusApprove(array $id);

}
