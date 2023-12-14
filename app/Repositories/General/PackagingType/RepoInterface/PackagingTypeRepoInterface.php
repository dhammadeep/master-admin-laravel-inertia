<?php

namespace App\Repositories\General\PackagingType\RepoInterface;

use App\Http\Requests\General\PackagingType\PackagingTypeRequest;

interface PackagingTypeRepoInterface
{
    public function add(PackagingTypeRequest $data);

    public function find(string $on = "", string $search = "", int $rowsPerPage = 50);

    public function findById(int $id);

    public function update(PackagingTypeRequest $data,int $id);

    public function getTableFields();

    public function updateStatusReject(array $id);

    public function updateStatusFinalize(array $id);

    public function updateStatusApprove(array $id);

}
