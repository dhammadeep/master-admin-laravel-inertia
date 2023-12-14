<?php

namespace App\Repositories\Farmer\EducationFarmer\RepoInterface;

use App\Http\Requests\Farmer\EducationFarmer\EducationFarmerRequest;

interface EducationFarmerRepoInterface
{
    public function add(EducationFarmerRequest $data);

    public function find(string $on = "", string $search = "", int $rowsPerPage = 50);

    public function findById(int $id);

    public function update(EducationFarmerRequest $data,int $id);

    public function getTableFields();

    public function updateStatusReject(array $id);

    public function updateStatusFinalize(array $id);

    public function updateStatusApprove(array $id);

}
