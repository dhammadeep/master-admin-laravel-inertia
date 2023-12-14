<?php

namespace App\Repositories\Geographical\TehsilAlias\RepoInterface;

use App\Http\Requests\Geographical\TehsilAlias\TehsilAliasRequest;

interface TehsilAliasRepoInterface
{
    public function add(TehsilAliasRequest $data);

    public function find(string $on = "", string $search = "", int $rowsPerPage = 50);

    public function findById(int $id);

    public function update(TehsilAliasRequest $data,int $id);

    public function getTableFields();

    public function updateStatusReject(array $id);

    public function updateStatusFinalize(array $id);

    public function updateStatusApprove(array $id);

}
