<?php

namespace App\Repositories\Regional\LanguageRegional\RepoInterface;

use App\Http\Requests\Regional\LanguageRegional\LanguageRegionalRequest;

interface LanguageRegionalRepoInterface
{
    public function add(LanguageRegionalRequest $data);

    public function find(string $on = "", string $search = "", int $rowsPerPage = 50);

    public function findById(int $id);

    public function update(LanguageRegionalRequest $data,int $id);

    public function getTableFields();

    public function updateStatusReject(array $id);

    public function updateStatusFinalize(array $id);

    public function updateStatusApprove(array $id);

}
