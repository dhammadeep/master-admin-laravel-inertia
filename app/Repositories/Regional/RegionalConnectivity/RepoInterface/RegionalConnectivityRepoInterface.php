<?php

namespace App\Repositories\Regional\RegionalConnectivity\RepoInterface;

use App\Http\Requests\Regional\RegionalConnectivity\RegionalConnectivityRequest;

interface RegionalConnectivityRepoInterface
{
    public function add(RegionalConnectivityRequest $data);

    public function find(string $on = "", string $search = "", int $rowsPerPage = 50);

    public function findById(int $id);

    public function update(RegionalConnectivityRequest $data,int $id);

    public function getTableFields();

    public function updateStatusReject(array $id);

    public function updateStatusFinalize(array $id);

    public function updateStatusApprove(array $id);

}
