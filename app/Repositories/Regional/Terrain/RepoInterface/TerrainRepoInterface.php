<?php

namespace App\Repositories\Regional\Terrain\RepoInterface;

use App\Http\Requests\Regional\Terrain\TerrainRequest;

interface TerrainRepoInterface
{
    public function add(TerrainRequest $data);

    public function find(string $on = "", string $search = "", int $rowsPerPage = 50);

    public function findById(int $id);

    public function update(TerrainRequest $data,int $id);

    public function getTableFields();

    public function updateStatusReject(array $id);

    public function updateStatusFinalize(array $id);

    public function updateStatusApprove(array $id);

}
