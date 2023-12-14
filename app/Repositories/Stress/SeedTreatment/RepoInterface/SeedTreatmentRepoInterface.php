<?php

namespace App\Repositories\Stress\SeedTreatment\RepoInterface;

use App\Http\Requests\Stress\SeedTreatment\SeedTreatmentRequest;

interface SeedTreatmentRepoInterface
{
    public function add(SeedTreatmentRequest $data);

    public function find(string $on = "", string $search = "", int $rowsPerPage = 50);

    public function all(string $on = "", string $search = "");

    public function findById(int $id);

    public function update(SeedTreatmentRequest $data,int $id);

    public function getTableFields();

    public function updateStatusReject(array $id);

    public function updateStatusFinalize(array $id);

    public function updateStatusApprove(array $id);

}
