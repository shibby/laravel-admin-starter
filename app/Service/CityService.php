<?php

namespace App\Service;

use App\Model\City;
use App\Model\District;
use Illuminate\Support\Collection;

class CityService
{
    public function getCities()
    {
        return City::all();
    }

    public function toSelect(): array
    {
        return City::pluck('name', 'id')->toArray();
    }

    /**
     * @param $cityId
     *
     * @return Collection
     */
    public function getDistricts($cityId): Collection
    {
        return District::where('city_id', $cityId)->get();
    }
}
