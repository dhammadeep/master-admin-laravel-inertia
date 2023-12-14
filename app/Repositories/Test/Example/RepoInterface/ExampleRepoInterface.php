<?php

namespace App\Repositories\Test\Example\RepoInterface;

use Illuminate\Http\Request;
use App\Http\Requests\Test\ExampleRequest;

interface ExampleRepoInterface
{
    public function add(string $s3url, ExampleRequest $data);

    public function addMany(ExampleRequest $data);

    public function find(string $on = "", string $search = "", int $rowsPerPage = 50);

    public function all(string $on = "", string $search = "");

    public function findById(int $id);

    public function update(ExampleRequest $data,int $id);

    public function delete();

    public function getTableFields();

    public function updateStatusReject(array $id);

    public function updateStatusFinalize(array $id);

    public function updateStatusApprove(array $id);
}
