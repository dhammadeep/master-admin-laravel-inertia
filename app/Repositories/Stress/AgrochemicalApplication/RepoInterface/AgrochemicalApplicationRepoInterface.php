<?php

namespace App\Repositories\Stress\AgrochemicalApplication\RepoInterface;

use App\Http\Requests\Stress\AgrochemicalApplication\AgrochemicalApplicationRequest;

interface AgrochemicalApplicationRepoInterface
{
    public function add(AgrochemicalApplicationRequest $data);

    public function find(string $on = "", string $search = "", int $rowsPerPage = 50);

    public function all(string $on = null, string $search = null);

    public function findById(int $id);

    public function update(AgrochemicalApplicationRequest $data, int $id);

    public function getTableFields();

    public function updateStatusReject(array $id);

    public function updateStatusFinalize(array $id);

    public function updateStatusApprove(array $id);
}
