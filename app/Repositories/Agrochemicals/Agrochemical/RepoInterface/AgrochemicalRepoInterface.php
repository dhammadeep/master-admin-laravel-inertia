<?php

namespace App\Repositories\Agrochemicals\Agrochemical\RepoInterface;

use App\Http\Requests\Agrochemicals\Agrochemical\AgrochemicalRequest;

interface AgrochemicalRepoInterface
{
    public function add(AgrochemicalRequest $data);

    public function find(string $on = "", string $search = "", int $rowsPerPage = 50);

    public function all(string $on = "", string $search = "");

    public function findById(int $id);

    public function update(AgrochemicalRequest $data,int $id);

    public function getTableFields();

    public function updateStatusReject(array $id);

    public function updateStatusFinalize(array $id);

    public function updateStatusApprove(array $id);

}
