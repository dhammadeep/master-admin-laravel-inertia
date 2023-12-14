<?php

namespace App\Repositories\Farmer\LanguageFarmer\RepoInterface;

use App\Http\Requests\Farmer\LanguageFarmer\LanguageFarmerRequest;

interface LanguageFarmerRepoInterface
{
    public function add(LanguageFarmerRequest $data);

    public function addMany(LanguageFarmerRequest $data);

    public function find(string $on = "", string $search = "", int $rowsPerPage = 50);

    public function all(string $on = "", string $search = "");

    public function findById(int $id);

    public function update(LanguageFarmerRequest $data,int $id);

    public function delete();

    public function getTableFields();

    public function updateStatusReject(array $id);

    public function updateStatusFinalize(array $id);

    public function updateStatusApprove(array $id);

}
