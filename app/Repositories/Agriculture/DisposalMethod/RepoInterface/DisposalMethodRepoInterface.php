<?php

namespace App\Repositories\Agriculture\DisposalMethod\RepoInterface;

use App\Http\Requests\Agriculture\DisposalMethod\DisposalMethodRequest;

interface DisposalMethodRepoInterface
{
    public function add(DisposalMethodRequest $data);

    public function find(string $on = "", string $search = "", int $rowsPerPage = 50);

    public function findById(int $id);

    public function update(DisposalMethodRequest $data, int $id);

    public function getTableFields();

    public function updateStatusReject(array $id);

    public function updateStatusFinalize(array $id);

    public function updateStatusApprove(array $id);
}
