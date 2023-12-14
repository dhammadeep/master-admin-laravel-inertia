<?php

namespace App\Repositories\Regional\StressRegional\RepoInterface;

use App\Http\Requests\Regional\StressRegional\StressRegionalRequest;

interface StressRegionalRepoInterface
{
    public function add(StressRegionalRequest $data);

    public function find(string $on = "", string $search = "", int $rowsPerPage = 50);

    public function findById(int $id);

    public function update(StressRegionalRequest $data,int $id);

    public function getTableFields();

    public function updateStatusReject(array $id);

    public function updateStatusFinalize(array $id);

    public function updateStatusApprove(array $id);

}
