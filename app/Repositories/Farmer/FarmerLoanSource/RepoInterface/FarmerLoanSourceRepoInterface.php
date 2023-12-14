<?php

namespace App\Repositories\Farmer\FarmerLoanSource\RepoInterface;

use App\Http\Requests\Farmer\FarmerLoanSource\FarmerLoanSourceRequest;

interface FarmerLoanSourceRepoInterface
{
    public function add(FarmerLoanSourceRequest $data);

    public function find(string $on = "", string $search = "", int $rowsPerPage = 50);

    public function findById(int $id);

    public function update(FarmerLoanSourceRequest $data,int $id);

    public function getTableFields();

    public function updateStatusReject(array $id);

    public function updateStatusFinalize(array $id);

    public function updateStatusApprove(array $id);

}
