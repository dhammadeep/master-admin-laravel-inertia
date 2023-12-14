<?php

namespace App\Repositories\General\Bank\RepoInterface;

use App\Http\Requests\General\Bank\BankRequest;

interface BankRepoInterface
{
    public function add(BankRequest $data);

    public function find(string $on = "", string $search = "", int $rowsPerPage = 50);

    public function all(string $on = "", string $search = "");

    public function findById(int $id);

    public function update(BankRequest $data,int $id);

    public function getTableFields();

    public function updateStatusReject(array $id);

    public function updateStatusFinalize(array $id);

    public function updateStatusApprove(array $id);

}
