<?php

namespace App\Repositories\Commodity\HSNCode\RepoInterface;

use App\Http\Requests\Commodity\HSNCode\HSNCodeRequest;

interface HSNCodeRepoInterface
{
    public function add(HSNCodeRequest $data);

    public function find(string $on = "", string $search = "", int $rowsPerPage = 50);
    
    public function all(string $on = "", string $search = "");

    public function findById(int $id);

    public function update(HSNCodeRequest $data,int $id);

    public function getTableFields();

    public function updateStatusReject(array $id);

    public function updateStatusFinalize(array $id);

    public function updateStatusApprove(array $id);

}
