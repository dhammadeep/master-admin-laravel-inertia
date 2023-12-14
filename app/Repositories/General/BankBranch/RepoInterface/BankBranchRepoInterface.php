<?php

namespace App\Repositories\General\BankBranch\RepoInterface;

use App\Http\Requests\General\BankBranch\BankBranchRequest;

interface BankBranchRepoInterface
{
    public function add(BankBranchRequest $data);

    public function find(string $on = "", string $search = "", int $rowsPerPage = 50);

    public function findById(int $id);

    public function update(BankBranchRequest $data,int $id);

    public function getTableFields();

    public function updateStatusReject(array $id);

    public function updateStatusFinalize(array $id);

    public function updateStatusApprove(array $id);

}
