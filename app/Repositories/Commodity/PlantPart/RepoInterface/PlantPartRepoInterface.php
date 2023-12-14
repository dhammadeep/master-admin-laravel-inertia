<?php

namespace App\Repositories\Commodity\PlantPart\RepoInterface;

use App\Http\Requests\Commodity\PlantPart\PlantPartRequest;

interface PlantPartRepoInterface
{
    public function add(PlantPartRequest $data);

    public function find(string $on = "", string $search = "", int $rowsPerPage = 50);

    public function all(string $on = "", string $search = "");

    public function findById(int $id);

    public function update(PlantPartRequest $data,int $id);

    public function getTableFields();

    public function updateStatusReject(array $id);

    public function updateStatusFinalize(array $id);

    public function updateStatusApprove(array $id);

}
