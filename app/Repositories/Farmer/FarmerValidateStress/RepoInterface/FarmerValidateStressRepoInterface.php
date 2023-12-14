<?php

namespace App\Repositories\Farmer\FarmerValidateStress\RepoInterface;

use App\Http\Requests\Farmer\FarmerValidateStress\FarmerValidateStressRequest;

interface FarmerValidateStressRepoInterface
{
    public function add(FarmerValidateStressRequest $data);

    public function find(string $on = "", string $search = "", int $rowsPerPage = 50);

    public function all(string $on = "", string $search = "");

    public function findById(int $id);

    public function update(FarmerValidateStressRequest $data,int $id);

    public function getTableFields();

    public function updateStatusReject(array $id);

    public function updateStatusFinalize(array $id);

    public function updateStatusApprove(array $id);

}
