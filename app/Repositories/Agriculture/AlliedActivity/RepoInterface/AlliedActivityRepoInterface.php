<?php

namespace App\Repositories\Agriculture\AlliedActivity\RepoInterface;

use App\Http\Requests\Agriculture\AlliedActivity\AlliedActivityRequest;

interface AlliedActivityRepoInterface
{
    public function add(AlliedActivityRequest $data);

    public function find(string $on = "", string $search = "", int $rowsPerPage = 50);

    public function findById(int $id);

    public function update(AlliedActivityRequest $data, int $id);

    public function getTableFields();

    public function updateStatusReject(array $id);

    public function updateStatusFinalize(array $id);

    public function updateStatusApprove(array $id);
}
