<?php

namespace App\Repositories\Zonal\Fertilizer\RepoInterface;

use App\Http\Requests\Zonal\Fertilizer\FertilizerRequest;

interface FertilizerRepoInterface
{
    public function add(FertilizerRequest $data);

     public function find(string $on = "", string $search = "", int $rowsPerPage = 50);

    public function findById(int $id);

    public function update(FertilizerRequest $data,int $id);

    public function getTableFields();

    public function updateStatusReject(array $id);

    public function updateStatusFinalize(array $id);

    public function updateStatusApprove(array $id);

}
