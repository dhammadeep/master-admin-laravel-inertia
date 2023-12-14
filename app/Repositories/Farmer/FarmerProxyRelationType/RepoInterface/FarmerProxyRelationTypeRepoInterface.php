<?php

namespace App\Repositories\Farmer\FarmerProxyRelationType\RepoInterface;

use App\Http\Requests\Farmer\FarmerProxyRelationType\FarmerProxyRelationTypeRequest;

interface FarmerProxyRelationTypeRepoInterface
{
    public function add(FarmerProxyRelationTypeRequest $data);

    public function find(string $on = "", string $search = "", int $rowsPerPage = 50);

    public function findById(int $id);

    public function update(FarmerProxyRelationTypeRequest $data,int $id);

    public function getTableFields();

    public function updateStatusReject(array $id);

    public function updateStatusFinalize(array $id);

    public function updateStatusApprove(array $id);

}
