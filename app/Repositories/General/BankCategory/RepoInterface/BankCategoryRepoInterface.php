<?php

namespace App\Repositories\General\BankCategory\RepoInterface;

use App\Http\Requests\General\BankCategory\BankCategoryRequest;

interface BankCategoryRepoInterface
{
    public function add(BankCategoryRequest $data);

    public function find(string $on = "", string $search = "", int $rowsPerPage = 50);

    public function all(string $on = "", string $search = "");

    public function findById(int $id);

    public function update(BankCategoryRequest $data,int $id);

    public function getTableFields();

    public function updateStatusReject(array $id);

    public function updateStatusFinalize(array $id);

    public function updateStatusApprove(array $id);

}
