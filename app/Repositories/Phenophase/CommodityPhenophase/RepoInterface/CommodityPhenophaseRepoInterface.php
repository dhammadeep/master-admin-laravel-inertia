<?php

namespace App\Repositories\Phenophase\CommodityPhenophase\RepoInterface;

use App\Http\Requests\Phenophase\CommodityPhenophase\CommodityPhenophaseRequest;

interface CommodityPhenophaseRepoInterface
{
    public function add(CommodityPhenophaseRequest $data);

    public function find(string $on = "", string $search = "", int $rowsPerPage = 50);

    public function all(string $on = "", string $search = "");

    public function findById(int $id);

    public function update(CommodityPhenophaseRequest $data, int $id);

    public function getTableFields();

    public function updateStatusReject(array $id);

    public function updateStatusFinalize(array $id);

    public function updateStatusApprove(array $id);
}
