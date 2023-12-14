<?php

namespace App\Repositories\Geographical\StateAlias\RepoInterface;

use App\Http\Requests\Geographical\StateAlias\StateAliasRequest;

interface StateAliasRepoInterface
{
    public function add(StateAliasRequest $data);

    public function find(string $on = "", string $search = "", int $rowsPerPage = 50);

    public function findById(int $id);

    public function update(StateAliasRequest $data,int $id);

    public function getTableFields();

    public function updateStatusReject(array $id);

    public function updateStatusFinalize(array $id);

    public function updateStatusApprove(array $id);

}
