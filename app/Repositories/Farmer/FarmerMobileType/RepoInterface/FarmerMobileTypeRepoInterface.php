<?php

namespace App\Repositories\Farmer\FarmerMobileType\RepoInterface;

use App\Http\Requests\Farmer\FarmerMobileType\FarmerMobileTypeRequest;

interface FarmerMobileTypeRepoInterface
{
    public function add(FarmerMobileTypeRequest $data);

    public function find(string $on = "", string $search = "", int $rowsPerPage = 50);

    public function findById(int $id);

    public function update(FarmerMobileTypeRequest $data,int $id);

    public function getTableFields();

    public function updateStatusReject(array $id);

    public function updateStatusFinalize(array $id);

    public function updateStatusApprove(array $id);

}
