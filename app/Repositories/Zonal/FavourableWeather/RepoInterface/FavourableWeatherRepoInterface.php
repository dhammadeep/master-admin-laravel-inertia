<?php

namespace App\Repositories\Zonal\FavourableWeather\RepoInterface;

use App\Http\Requests\Zonal\FavourableWeather\FavourableWeatherRequest;

interface FavourableWeatherRepoInterface
{
    public function add(FavourableWeatherRequest $data);

    public function find(string $on = "", string $search = "", int $rowsPerPage = 50);

    public function findById(int $id);

    public function update(FavourableWeatherRequest $data,int $id);

    public function getTableFields();

    public function updateStatusReject(array $id);

    public function updateStatusFinalize(array $id);

    public function updateStatusApprove(array $id);

}
