<?php

namespace App\Repositories\Stress\AgrochemicalInstructions\RepoInterface;

use App\Http\Requests\Stress\AgrochemicalInstructions\AgrochemicalInstructionsRequest;

interface AgrochemicalInstructionsRepoInterface
{
    public function add(AgrochemicalInstructionsRequest $data);

    public function find(string $on = "", string $search = "", int $rowsPerPage = 50);

    public function all(string $on = null, string $search = null);

    public function findById(int $id);

    public function update(AgrochemicalInstructionsRequest $data, int $id);

    public function getTableFields();

    public function updateStatusReject(array $id);

    public function updateStatusFinalize(array $id);

    public function updateStatusApprove(array $id);
}
