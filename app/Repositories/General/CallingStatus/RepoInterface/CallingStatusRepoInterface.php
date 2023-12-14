<?php

namespace App\Repositories\General\CallingStatus\RepoInterface;

use App\Http\Requests\General\CallingStatus\CallingStatusRequest;

interface CallingStatusRepoInterface
{
    public function add(CallingStatusRequest $data);

    public function find(string $on = "", string $search = "", int $rowsPerPage = 50);

    public function findById(int $id);

    public function update(CallingStatusRequest $data,int $id);

    public function getTableFields();

    public function updateStatusReject(array $id);

    public function updateStatusFinalize(array $id);

    public function updateStatusApprove(array $id);

}
