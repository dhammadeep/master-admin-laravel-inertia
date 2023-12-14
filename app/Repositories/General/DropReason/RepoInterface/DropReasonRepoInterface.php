<?php

namespace App\Repositories\General\DropReason\RepoInterface;

use App\Http\Requests\General\DropReason\DropReasonRequest;

interface DropReasonRepoInterface
{
    public function add(DropReasonRequest $data);

    public function find(string $on = "", string $search = "", int $rowsPerPage = 50);

    public function findById(int $id);

    public function update(DropReasonRequest $data,int $id);

    public function getTableFields();

    public function updateStatusReject(array $id);

    public function updateStatusFinalize(array $id);

    public function updateStatusApprove(array $id);

}
