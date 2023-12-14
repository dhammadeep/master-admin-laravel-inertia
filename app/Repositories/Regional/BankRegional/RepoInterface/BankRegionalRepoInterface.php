<?php

namespace App\Repositories\Regional\BankRegional\RepoInterface;

use App\Http\Requests\Regional\BankRegional\BankRegionalRequest;

interface BankRegionalRepoInterface
{
    public function add(BankRegionalRequest $data);

     public function findAll(string $on = "", string $search = "", int $rowsPerPage = 50);

    public function findById(int $id);

    public function update(BankRegionalRequest $data,int $id);

    public function getTableFields();

    public function updateStatusReject(array $id);

    public function updateStatusFinalize(array $id);

    public function updateStatusApprove(array $id);

}
