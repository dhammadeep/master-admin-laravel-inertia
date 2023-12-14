<?php

namespace App\Repositories\Geographical\DistrictAlias\RepoInterface;

use App\Http\Requests\Geographical\DistrictAlias\DistrictAliasRequest;

interface DistrictAliasRepoInterface
{
    public function add(DistrictAliasRequest $data);

    public function find(string $on = "", string $search = "", int $rowsPerPage = 50);

    public function findById(int $id);

    public function update(DistrictAliasRequest $data,int $id);

    public function getTableFields();

    public function updateStatusReject(array $id);

    public function updateStatusFinalize(array $id);

    public function updateStatusApprove(array $id);

}
