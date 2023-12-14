<?php

namespace App\Repositories\Test\Demo\RepoInterface;

use App\Http\Requests\Test\Demo\DemoRequest;

interface DemoRepoInterface
{
    public function add(DemoRequest $data);

    public function find(string $on = "", string $search = "", int $rowsPerPage = 50);

    public function findById(int $id);

    public function update(DemoRequest $data,int $id);

    public function getTableFields();

    public function updateStatusReject(array $id);

    public function updateStatusFinalize(array $id);

    public function updateStatusApprove(array $id);

}
