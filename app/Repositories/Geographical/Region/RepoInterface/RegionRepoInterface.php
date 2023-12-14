<?php

namespace App\Repositories\Geographical\Region\RepoInterface;

use App\Http\Requests\Geographical\Region\RegionRequest;

interface RegionRepoInterface
{
    public function add(RegionRequest $data);

    public function find(string $on = "", string $search = "", int $rowsPerPage = 50);

    public function all(string $on = "", string $search = "");

    public function findById(int $id);

    public function update(RegionRequest $data,int $id);

    public function getTableFields();

    public function updateStatusReject(array $id);

    public function updateStatusFinalize(array $id);

    public function updateStatusApprove(array $id);

}
