<?php

namespace App\Repositories\Farmer\FarmOwnershipType\RepoInterface;

use App\Http\Requests\Farmer\FarmOwnershipType\FarmOwnershipTypeRequest;

interface FarmOwnershipTypeRepoInterface
{
    public function add(FarmOwnershipTypeRequest $data);

    public function find(string $on = "", string $search = "", int $rowsPerPage = 50);

    public function findById(int $id);

    public function update(FarmOwnershipTypeRequest $data,int $id);

    public function getTableFields();

    public function updateStatusReject(array $id);

    public function updateStatusFinalize(array $id);

    public function updateStatusApprove(array $id);

}
