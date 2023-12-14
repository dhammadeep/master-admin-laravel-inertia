<?php

namespace App\Repositories\Commodity\Variety\RepoInterface;

use App\Http\Requests\Commodity\Variety\VarietyRequest;

interface VarietyRepoInterface
{
    public function add(VarietyRequest $data);

    public function find(string $on = "", string $search = "", int $rowsPerPage = 50);

    public function all(string $on = "", string $search = "");

    public function findById(int $id);

    public function update(VarietyRequest $data,int $id);

    public function getTableFields();

    public function updateStatusReject(array $id);

    public function updateStatusFinalize(array $id);

    public function updateStatusApprove(array $id);

}
