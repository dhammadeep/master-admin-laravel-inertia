<?php

namespace App\Repositories\Farmer\FarmerIdProof\RepoInterface;

use App\Http\Requests\Farmer\FarmerIdProof\FarmerIdProofRequest;

interface FarmerIdProofRepoInterface
{
    public function add(FarmerIdProofRequest $data);

    public function find(string $on = "", string $search = "", int $rowsPerPage = 50);

    public function findById(int $id);

    public function update(FarmerIdProofRequest $data,int $id);

    public function getTableFields();

    public function updateStatusReject(array $id);

    public function updateStatusFinalize(array $id);

    public function updateStatusApprove(array $id);

}
