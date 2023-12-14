<?php

namespace App\Repositories\Agrochemicals\AgroCommoditychemical\RepoInterface;

use App\Http\Requests\Agrochemicals\AgroCommoditychemical\AgroCommoditychemicalRequest;

interface AgroCommoditychemicalRepoInterface
{
    public function add(AgroCommoditychemicalRequest $data);

    public function find(string $on = "", string $search = "", int $rowsPerPage = 50);

    public function all(string $on = "", string $search = "");

    public function findById(int $id);

    public function update(AgroCommoditychemicalRequest $data,int $id);

    public function getTableFields();

    public function updateStatusReject(array $id);

    public function updateStatusFinalize(array $id);

    public function updateStatusApprove(array $id);

}
