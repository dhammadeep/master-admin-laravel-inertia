<?php

namespace App\Repositories\Commodity\CommodityPlantPart\RepoInterface;

use App\Http\Requests\Commodity\CommodityPlantPart\CommodityPlantPartRequest;

interface CommodityPlantPartRepoInterface
{
    public function add(string $s3url,CommodityPlantPartRequest $data);

    public function find(string $on = "", string $search = "", int $rowsPerPage = 50);

    public function all(string $on = "", string $search = "");

    public function findById(int $id);

    public function update(CommodityPlantPartRequest $data,int $id);

    public function getTableFields();

    public function updateStatusReject(array $id);

    public function updateStatusFinalize(array $id);

    public function updateStatusApprove(array $id);

}
