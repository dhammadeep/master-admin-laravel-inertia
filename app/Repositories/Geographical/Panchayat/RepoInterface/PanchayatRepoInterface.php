<?php

namespace App\Repositories\Geographical\Panchayat\RepoInterface;

use App\Http\Requests\Geographical\Panchayat\PanchayatRequest;

interface PanchayatRepoInterface
{
    public function add(PanchayatRequest $data);

    public function find(string $on = "", string $search = "", int $rowsPerPage = 50);

    public function all(string $on = "", string $search = "");

    public function findById(int $id);

    public function update(PanchayatRequest $data,int $id);

    public function getTableFields();

    public function updateStatusReject(array $id);

    public function updateStatusFinalize(array $id);

    public function updateStatusApprove(array $id);

}
