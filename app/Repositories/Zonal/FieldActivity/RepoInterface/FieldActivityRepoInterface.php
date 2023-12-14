<?php

namespace App\Repositories\Zonal\FieldActivity\RepoInterface;

use App\Http\Requests\Zonal\FieldActivity\FieldActivityRequest;

interface FieldActivityRepoInterface
{
    public function add(string $fileUrl, FieldActivityRequest $data);

    public function find(string $on = "", string $search = "", int $rowsPerPage = 50);

    public function findById(int $id);

    public function update(string $fileUrl, FieldActivityRequest $data,int $id);

    public function getTableFields();

    public function updateStatusReject(array $id);

    public function updateStatusFinalize(array $id);

    public function updateStatusApprove(array $id);

}
