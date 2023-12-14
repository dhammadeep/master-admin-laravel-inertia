<?php

namespace App\Repositories\Farmer\FarmerInsuranceType\RepoInterface;

use App\Http\Requests\Farmer\FarmerInsuranceType\FarmerInsuranceTypeRequest;

interface FarmerInsuranceTypeRepoInterface
{
    public function add(FarmerInsuranceTypeRequest $data);

    public function find(string $on = "", string $search = "", int $rowsPerPage = 50);

    public function all(string $on = "", string $search = "");

    public function findById(int $id);

    public function update(FarmerInsuranceTypeRequest $data,int $id);

    public function getTableFields();

    public function updateStatusReject(array $id);

    public function updateStatusFinalize(array $id);

    public function updateStatusApprove(array $id);

}
