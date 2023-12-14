<?php

namespace App\Repositories\Geographical\Acz\RepoInterface;

use App\Http\Requests\Geographical\Acz\AczRequest;

interface AczRepoInterface
{
    public function add(AczRequest $data);

    public function find(string $on = "", string $search = "", int $rowsPerPage = 50);

    public function all(string $on = "", string $search = "");

    public function findById(int $id);

    public function update(AczRequest $data,int $id);

    public function getTableFields();

    public function updateStatusReject(array $id);

    public function updateStatusFinalize(array $id);

    public function updateStatusApprove(array $id);

}
