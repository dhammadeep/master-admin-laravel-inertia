<?php

namespace App\Repositories\General\Company\RepoInterface;

use App\Http\Requests\General\Company\CompanyRequest;

interface CompanyRepoInterface
{
    public function add(CompanyRequest $data);

    public function find(string $on = "", string $search = "", int $rowsPerPage = 50);

    public function all(string $on = "", string $search = "");

    public function findById(int $id);

    public function update(CompanyRequest $data,int $id);

    public function getTableFields();

    public function updateStatusReject(array $id);

    public function updateStatusFinalize(array $id);

    public function updateStatusApprove(array $id);

}
