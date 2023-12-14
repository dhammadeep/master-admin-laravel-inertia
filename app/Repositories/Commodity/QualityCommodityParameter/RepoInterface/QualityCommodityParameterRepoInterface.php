<?php

namespace App\Repositories\Commodity\QualityCommodityParameter\RepoInterface;

use App\Http\Requests\Commodity\QualityCommodityParameter\QualityCommodityParameterRequest;

interface QualityCommodityParameterRepoInterface
{
    public function add(QualityCommodityParameterRequest $data);

    public function find(string $on = "", string $search = "", int $rowsPerPage = 50);

    public function all(string $on = "", string $search = "");

    public function findById(int $id);

    public function update(QualityCommodityParameterRequest $data,int $id);

    public function getTableFields();

    public function updateStatusReject(array $id);

    public function updateStatusFinalize(array $id);

    public function updateStatusApprove(array $id);

}
