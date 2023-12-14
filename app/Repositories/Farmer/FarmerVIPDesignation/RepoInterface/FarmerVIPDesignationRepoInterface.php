<?php

namespace App\Repositories\Farmer\FarmerVIPDesignation\RepoInterface;

use App\Http\Requests\Farmer\FarmerVIPDesignation\FarmerVIPDesignationRequest;

interface FarmerVIPDesignationRepoInterface
{
    public function add(FarmerVIPDesignationRequest $data);

    public function find(string $on = "", string $search = "", int $rowsPerPage = 50);

    public function findById(int $id);

    public function update(FarmerVIPDesignationRequest $data,int $id);

    public function getTableFields();

    public function updateStatusReject(array $id);

    public function updateStatusFinalize(array $id);

    public function updateStatusApprove(array $id);

}
