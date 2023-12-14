<?php

namespace App\Repositories\Regional\WeatherTravelTime\RepoInterface;

use App\Http\Requests\Regional\WeatherTravelTime\WeatherTravelTimeRequest;

interface WeatherTravelTimeRepoInterface
{
    public function add(WeatherTravelTimeRequest $data);

    public function find(string $on = "", string $search = "", int $rowsPerPage = 50);

    public function findById(int $id);

    public function update(WeatherTravelTimeRequest $data,int $id);

    public function getTableFields();

    public function updateStatusReject(array $id);

    public function updateStatusFinalize(array $id);

    public function updateStatusApprove(array $id);

}
