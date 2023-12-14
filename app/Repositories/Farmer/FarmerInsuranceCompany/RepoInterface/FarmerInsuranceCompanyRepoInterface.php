<?php

namespace App\Repositories\Farmer\FarmerInsuranceCompany\RepoInterface;

use App\Http\Requests\Farmer\FarmerInsuranceCompany\FarmerInsuranceCompanyRequest;

interface FarmerInsuranceCompanyRepoInterface
{
    public function add(FarmerInsuranceCompanyRequest $data);

    public function find(string $on = "", string $search = "", int $rowsPerPage = 50);

    public function findById(int $id);

    public function update(FarmerInsuranceCompanyRequest $data,int $id);

    public function getTableFields();

    public function updateStatusReject(array $id);

    public function updateStatusFinalize(array $id);

    public function updateStatusApprove(array $id);

}
