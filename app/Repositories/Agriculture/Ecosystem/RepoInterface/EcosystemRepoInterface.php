<?php

namespace App\Repositories\Agriculture\Ecosystem\RepoInterface;

use App\Http\Requests\Agriculture\Ecosystem\EcosystemRequest;

interface EcosystemRepoInterface
{
    public function add(EcosystemRequest $data);

    public function find(string $on = "", string $search = "", int $rowsPerPage = 50);

    public function findById(int $id);

    public function update(EcosystemRequest $data, int $id);

    public function getTableFields();

    public function updateStatusReject(array $id);

    public function updateStatusFinalize(array $id);

    public function updateStatusApprove(array $id);
}
