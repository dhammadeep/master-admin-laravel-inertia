<?php

namespace App\Repositories\Agriculture\Band\RepoInterface;

use App\Http\Requests\Agriculture\Band\BandRequest;

interface BandRepoInterface
{
    public function add(BandRequest $data);

    public function find(string $on = "", string $search = "", int $rowsPerPage = 50);

    public function all(string $on = null, string $search = null);

    public function findById(int $id);

    public function update(BandRequest $data,int $id);

    public function getTableFields();

    public function updateStatusReject(array $id);

    public function updateStatusFinalize(array $id);

    public function updateStatusApprove(array $id);

}
