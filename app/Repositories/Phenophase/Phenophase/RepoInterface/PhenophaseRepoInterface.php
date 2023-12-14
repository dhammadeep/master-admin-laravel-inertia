<?php

namespace App\Repositories\Phenophase\Phenophase\RepoInterface;

use App\Http\Requests\Phenophase\Phenophase\PhenophaseRequest;

interface PhenophaseRepoInterface
{
    public function add(PhenophaseRequest $data);

    public function find(string $on = "", string $search = "", int $rowsPerPage = 50);

    public function all(string $on = "", string $search = "");

    public function findById(int $id);

    public function update(PhenophaseRequest $data, int $id);

    public function getTableFields();

    public function updateStatusReject(array $id);

    public function updateStatusFinalize(array $id);

    public function updateStatusApprove(array $id);
}
