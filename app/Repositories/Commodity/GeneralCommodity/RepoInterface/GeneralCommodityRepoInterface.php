<?php

namespace App\Repositories\Commodity\GeneralCommodity\RepoInterface;

use App\Http\Requests\Commodity\GeneralCommodity\GeneralCommodityRequest;

interface GeneralCommodityRepoInterface
{
    public function add(GeneralCommodityRequest $data);

    public function find(string $on = "", string $search = "", int $rowsPerPage = 50);

    public function all(string $on = "", string $search = "");

    public function findById(int $id);

    public function update(GeneralCommodityRequest $data,int $id);

    public function getTableFields();

    public function updateStatusReject(array $id);

    public function updateStatusFinalize(array $id);

    public function updateStatusApprove(array $id);

}
