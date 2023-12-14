<?php

namespace App\Repositories\General\WeatherParams\RepoInterface;

use App\Http\Requests\General\WeatherParams\WeatherParamsRequest;

interface WeatherParamsRepoInterface
{
    public function add(WeatherParamsRequest $data);

    public function find(string $on = "", string $search = "", int $rowsPerPage = 50);

    public function all(string $on = null, string $search = null);

    public function findById(int $id);

    public function update(WeatherParamsRequest $data,int $id);

    public function getTableFields();

    public function updateStatusReject(array $id);

    public function updateStatusFinalize(array $id);

    public function updateStatusApprove(array $id);

}
