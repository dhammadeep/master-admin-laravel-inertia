<?php

namespace App\Repositories\Geographical\District\RepoInterface;

use App\Http\Requests\Geographical\District\DistrictRequest;

interface DistrictRepoInterface
{
    public function add(DistrictRequest $data);

    public function find(string $on = "", string $search = "", int $rowsPerPage = 50);

    public function all(string $on = "", string $search = "");

    public function findById(int $id);

    public function update(DistrictRequest $data,int $id);

    public function getTableFields();

    public function updateStatusReject(array $id);

    public function updateStatusFinalize(array $id);

    public function updateStatusApprove(array $id);

}
