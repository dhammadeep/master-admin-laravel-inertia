<?php

namespace App\Repositories\Config\SyncConfig\RepoInterface;

use App\Http\Requests\Config\SyncConfig\SyncConfigRequest;

interface SyncConfigRepoInterface
{
    public function add(SyncConfigRequest $data);

     public function findAll(string $on = "", string $search = "", int $rowsPerPage = 50);

    public function findById(int $id);

    public function update(SyncConfigRequest $data,int $id);

    public function getTableFields();

    public function updateStatusReject(array $id);

    public function updateStatusFinalize(array $id);

    public function updateStatusApprove(array $id);

}
