<?php

namespace App\Repositories\Farmer\FarmerEnrollmentPlace\RepoInterface;

use App\Http\Requests\Farmer\FarmerEnrollmentPlace\FarmerEnrollmentPlaceRequest;

interface FarmerEnrollmentPlaceRepoInterface
{
    public function add(FarmerEnrollmentPlaceRequest $data);

    public function find(string $on = "", string $search = "", int $rowsPerPage = 50);

    public function findById(int $id);

    public function update(FarmerEnrollmentPlaceRequest $data,int $id);

    public function getTableFields();

    public function updateStatusReject(array $id);

    public function updateStatusFinalize(array $id);

    public function updateStatusApprove(array $id);

}
