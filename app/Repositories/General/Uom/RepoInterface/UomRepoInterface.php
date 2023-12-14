<?php

namespace App\Repositories\General\Uom\RepoInterface;

use App\Http\Requests\General\Uom\UomRequest;

interface UomRepoInterface
{
    public function add(UomRequest $data);

    public function find(string $on = "", string $search = "", int $rowsPerPage = 50);

    public function all(string $on = "", string $search = "");

    public function findById(int $id);

    public function update(UomRequest $data,int $id);

    public function getTableFields();

    public function updateStatusReject(array $id);

    public function updateStatusFinalize(array $id);

    public function updateStatusApprove(array $id);

}
