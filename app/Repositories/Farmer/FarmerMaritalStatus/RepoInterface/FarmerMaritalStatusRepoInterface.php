<?php

namespace App\Repositories\Farmer\FarmerMaritalStatus\RepoInterface;

use App\Http\Requests\Farmer\FarmerMaritalStatus\FarmerMaritalStatusRequest;

interface FarmerMaritalStatusRepoInterface
{
    public function add(FarmerMaritalStatusRequest $data);

    public function find(string $on = "", string $search = "", int $rowsPerPage = 50);

    public function findById(int $id);

    public function update(FarmerMaritalStatusRequest $data,int $id);

    public function getTableFields();

    public function updateStatusReject(array $id);

    public function updateStatusFinalize(array $id);

    public function updateStatusApprove(array $id);

}
