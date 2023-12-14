<?php

namespace App\Repositories\Zonal\PlantHealthIndex\RepoInterface;

use App\Http\Requests\Zonal\PlantHealthIndex\PlantHealthIndexRequest;

interface PlantHealthIndexRepoInterface
{
    public function add(PlantHealthIndexRequest $data);

    public function find(string $on = "", string $search = "", int $rowsPerPage = 50);

    public function findById(int $id);

    public function update(PlantHealthIndexRequest $data,int $id);

    public function getTableFields();

    public function updateStatusReject(array $id);

    public function updateStatusFinalize(array $id);

    public function updateStatusApprove(array $id);

}
