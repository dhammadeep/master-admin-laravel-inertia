<?php

namespace App\Repositories\Farmer\FarmerVIPStatus\RepoInterface;

use App\Http\Requests\Farmer\FarmerVIPStatus\FarmerVIPStatusRequest;

interface FarmerVIPStatusRepoInterface
{
    public function add(FarmerVIPStatusRequest $data);

    public function find(string $on = "", string $search = "", int $rowsPerPage = 50);

    public function findById(int $id);

    public function update(FarmerVIPStatusRequest $data,int $id);

    public function getTableFields();

    public function updateStatusReject(array $id);

    public function updateStatusFinalize(array $id);

    public function updateStatusApprove(array $id);

}
