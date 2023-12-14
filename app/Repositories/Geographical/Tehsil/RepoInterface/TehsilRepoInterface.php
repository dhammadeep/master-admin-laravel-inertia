<?php

namespace App\Repositories\Geographical\Tehsil\RepoInterface;

use App\Http\Requests\Geographical\Tehsil\TehsilRequest;

interface TehsilRepoInterface
{
    public function add(TehsilRequest $data);

    public function find(string $on = "", string $search = "", int $rowsPerPage = 50);

    public function all(string $on = "", string $search = "");

    public function findById(int $id);

    public function update(TehsilRequest $data,int $id);

    public function getTableFields();

    public function updateStatusReject(array $id);

    public function updateStatusFinalize(array $id);

    public function updateStatusApprove(array $id);

}
