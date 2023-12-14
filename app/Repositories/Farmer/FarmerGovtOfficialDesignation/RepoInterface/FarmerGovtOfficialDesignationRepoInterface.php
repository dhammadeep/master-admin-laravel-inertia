<?php

namespace App\Repositories\Farmer\FarmerGovtOfficialDesignation\RepoInterface;

use App\Http\Requests\Farmer\FarmerGovtOfficialDesignation\FarmerGovtOfficialDesignationRequest;

interface FarmerGovtOfficialDesignationRepoInterface
{
    public function add(FarmerGovtOfficialDesignationRequest $data);

    public function find(string $on = "", string $search = "", int $rowsPerPage = 50);

    public function findById(int $id);

    public function update(FarmerGovtOfficialDesignationRequest $data,int $id);

    public function getTableFields();

    public function updateStatusReject(array $id);

    public function updateStatusFinalize(array $id);

    public function updateStatusApprove(array $id);

}
