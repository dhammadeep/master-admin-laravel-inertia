<?php

namespace App\Repositories\General\TypeOfService\RepoInterface;

use App\Http\Requests\General\TypeOfService\TypeOfServiceRequest;

interface TypeOfServiceRepoInterface
{
    public function add(TypeOfServiceRequest $data);

    public function find(string $on = "", string $search = "", int $rowsPerPage = 50);

    public function findById(int $id);

    public function update(TypeOfServiceRequest $data,int $id);

    public function getTableFields();

    public function updateStatusReject(array $id);

    public function updateStatusFinalize(array $id);

    public function updateStatusApprove(array $id);

}
