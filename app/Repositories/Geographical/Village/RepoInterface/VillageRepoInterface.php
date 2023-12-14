<?php

namespace App\Repositories\Geographical\Village\RepoInterface;

use App\Http\Requests\Geographical\Village\VillageRequest;

interface VillageRepoInterface
{
    public function add(VillageRequest $data);

    public function find(string $on = "", string $search = "", int $rowsPerPage = 50);

    public function all(string $on = "", string $search = "");

    public function findById(int $id);

    public function update(VillageRequest $data,int $id);

    public function getTableFields();

    public function updateStatusReject(array $id);

    public function updateStatusFinalize(array $id);

    public function updateStatusApprove(array $id);

}
