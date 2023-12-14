<?php

namespace App\Repositories\Commodity\QualityParameter\RepoInterface;

use App\Http\Requests\Commodity\QualityParameter\QualityParameterRequest;

interface QualityParameterRepoInterface
{
    public function add(QualityParameterRequest $data);

    public function find(string $on = "", string $search = "", int $rowsPerPage = 50);

    public function findById(int $id);

    public function update(QualityParameterRequest $data,int $id);

    public function getTableFields();

    public function updateStatusReject(array $id);

    public function updateStatusFinalize(array $id);

    public function updateStatusApprove(array $id);

}
