<?php

namespace App\Repositories\Agriculture\FarmMachinery\RepoInterface;

use App\Http\Requests\Agriculture\FarmMachinery\FarmMachineryRequest;

interface FarmMachineryRepoInterface
{
    public function add(FarmMachineryRequest $data);

    public function find(string $on = "", string $search = "", int $rowsPerPage = 50);

    public function findById(int $id);

    public function update(FarmMachineryRequest $data, int $id);

    public function getTableFields();

    public function updateStatusReject(array $id);

    public function updateStatusFinalize(array $id);

    public function updateStatusApprove(array $id);
}
