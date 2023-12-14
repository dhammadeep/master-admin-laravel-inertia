<?php

namespace App\Repositories\Regional\MonthlyTravelTime\RepoInterface;

use App\Http\Requests\Regional\MonthlyTravelTime\MonthlyTravelTimeRequest;

interface MonthlyTravelTimeRepoInterface
{
    public function add(MonthlyTravelTimeRequest $data);

    public function find(string $on = "", string $search = "", int $rowsPerPage = 50);

    public function findById(int $id);

    public function update(MonthlyTravelTimeRequest $data,int $id);

    public function getTableFields();

    public function updateStatusReject(array $id);

    public function updateStatusFinalize(array $id);

    public function updateStatusApprove(array $id);

}
