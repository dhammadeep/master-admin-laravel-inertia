<?php

namespace App\Repositories\Regional\CommodityRegional\RepoInterface;

use App\Http\Requests\Regional\CommodityRegional\CommodityRegionalRequest;

interface CommodityRegionalRepoInterface
{
    public function add(CommodityRegionalRequest $data);

    public function find(string $on = "", string $search = "", int $rowsPerPage = 50);

    public function findById(int $id);

    public function update(CommodityRegionalRequest $data,int $id);

    public function getTableFields();

    public function updateStatusReject(array $id);

    public function updateStatusFinalize(array $id);

    public function updateStatusApprove(array $id);

}
