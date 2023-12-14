<?php

namespace App\Repositories\Farmer\FarmerIncomeSource\RepoInterface;

use App\Http\Requests\Farmer\FarmerIncomeSource\FarmerIncomeSourceRequest;

interface FarmerIncomeSourceRepoInterface
{
    public function add(FarmerIncomeSourceRequest $data);

    public function find(string $on = "", string $search = "", int $rowsPerPage = 50);

    public function findById(int $id);

    public function update(FarmerIncomeSourceRequest $data,int $id);

    public function getTableFields();

    public function updateStatusReject(array $id);

    public function updateStatusFinalize(array $id);

    public function updateStatusApprove(array $id);

}
