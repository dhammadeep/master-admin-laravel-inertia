<?php

namespace App\Repositories\Agriculture\Season\RepoInterface;

use App\Http\Requests\Agriculture\Season\SeasonRequest;

interface SeasonRepoInterface
{
    public function add(SeasonRequest $data);

    public function find(string $on = "", string $search = "", int $rowsPerPage = 50);

    public function all(string $on = "", string $search = "");

    public function findById(int $id);

    public function update(SeasonRequest $data, int $id);

    public function getTableFields();

    public function updateStatusReject(array $id);

    public function updateStatusFinalize(array $id);

    public function updateStatusApprove(array $id);
}
