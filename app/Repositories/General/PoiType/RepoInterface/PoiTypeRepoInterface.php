<?php

namespace App\Repositories\General\PoiType\RepoInterface;

use App\Http\Requests\General\PoiType\PoiTypeRequest;

interface PoiTypeRepoInterface
{
    public function add(PoiTypeRequest $data);

    public function find(string $on = "", string $search = "", int $rowsPerPage = 50);

    public function findById(int $id);

    public function update(PoiTypeRequest $data,int $id);

    public function getTableFields();

    public function updateStatusReject(array $id);

    public function updateStatusFinalize(array $id);

    public function updateStatusApprove(array $id);

}
