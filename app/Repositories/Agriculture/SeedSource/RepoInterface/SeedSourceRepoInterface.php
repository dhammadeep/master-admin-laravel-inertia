<?php

namespace App\Repositories\Agriculture\SeedSource\RepoInterface;

use App\Http\Requests\Agriculture\SeedSource\SeedSourceRequest;

interface SeedSourceRepoInterface
{
    public function add(SeedSourceRequest $data);

    public function find(string $on = "", string $search = "", int $rowsPerPage = 50);

    public function findById(int $id);

    public function update(SeedSourceRequest $data, int $id);

    public function getTableFields();

    public function updateStatusReject(array $id);

    public function updateStatusFinalize(array $id);

    public function updateStatusApprove(array $id);
}
