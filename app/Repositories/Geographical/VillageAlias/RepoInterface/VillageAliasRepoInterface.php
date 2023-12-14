<?php

namespace App\Repositories\Geographical\VillageAlias\RepoInterface;

use App\Http\Requests\Geographical\VillageAlias\VillageAliasRequest;

interface VillageAliasRepoInterface
{
    public function add(VillageAliasRequest $data);

    public function find(string $on = "", string $search = "", int $rowsPerPage = 50);

    public function findById(int $id);

    public function update(VillageAliasRequest $data,int $id);

    public function getTableFields();

    public function updateStatusReject(array $id);

    public function updateStatusFinalize(array $id);

    public function updateStatusApprove(array $id);

}
