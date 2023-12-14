<?php

namespace App\Repositories\Stress\StressSeverity\RepoInterface;

use App\Http\Requests\Stress\StressSeverity\StressSeverityRequest;

interface StressSeverityRepoInterface
{
    public function add(StressSeverityRequest $data);

    public function find(string $on = "", string $search = "", int $rowsPerPage = 50);

    public function all(string $on = "", string $search = "");

    public function findById(int $id);

    public function update(StressSeverityRequest $data, int $id);

    public function getTableFields();

    public function updateStatusReject(array $id);

    public function updateStatusFinalize(array $id);

    public function updateStatusApprove(array $id);
}
