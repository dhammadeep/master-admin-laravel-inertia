<?php

namespace App\Repositories\Agriculture\AgricultureFertilizer\RepoInterface;

use App\Http\Requests\Agriculture\AgricultureFertilizer\AgricultureFertilizerRequest;

interface AgricultureFertilizerRepoInterface
{
    public function add(AgricultureFertilizerRequest $data);

    public function find(string $on = "", string $search = "", int $rowsPerPage = 50);

    public function all(string $on = "", string $search = "");

    public function findById(int $id);

    public function update(AgricultureFertilizerRequest $data,int $id);

    public function getTableFields();

    public function updateStatusReject(array $id);

    public function updateStatusFinalize(array $id);

    public function updateStatusApprove(array $id);

}
