<?php

namespace App\Repositories\Commodity\StateCommodity\RepoInterface;

use App\Http\Requests\Commodity\StateCommodity\StateCommodityRequest;

interface StateCommodityRepoInterface
{
    public function add(StateCommodityRequest $data);

    public function find(string $on = "", string $search = "", int $rowsPerPage = 50);

    public function findById(int $id);

    public function update(StateCommodityRequest $data,int $id);

    public function getTableFields();

    public function updateStatusReject(array $id);

    public function updateStatusFinalize(array $id);

    public function updateStatusApprove(array $id);

}
