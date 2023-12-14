<?php

namespace App\Repositories\Farmer\FarmerGovtDepartment\RepoInterface;

use App\Http\Requests\Farmer\FarmerGovtDepartment\FarmerGovtDepartmentRequest;

interface FarmerGovtDepartmentRepoInterface
{
    public function add(FarmerGovtDepartmentRequest $data);

    public function find(string $on = "", string $search = "", int $rowsPerPage = 50);

    public function all(string $on = "", string $search = "");

    public function findById(int $id);

    public function update(FarmerGovtDepartmentRequest $data,int $id);

    public function getTableFields();

    public function updateStatusReject(array $id);

    public function updateStatusFinalize(array $id);

    public function updateStatusApprove(array $id);

}
