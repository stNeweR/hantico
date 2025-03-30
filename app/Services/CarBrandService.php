<?php

namespace App\Services;

use App\DTO\CarBrandDto;
use App\Dto\CarBrandFilterDto;
use App\Models\CarBrand;

class CarBrandService
{
    public function get(CarBrandFilterDto $filterDto)
    {
        $query = CarBrand::query();

        if ($filterDto->title) {
            $query->where('title', 'like', '%' . $filterDto->title . '%');
        }

        return $query->get();
    }

    public function delete(int $id): bool|null
    {
        $carBrand = CarBrand::query()->findOrFail($id);
        return $carBrand->delete();
    }

    public function create(CarBrandDto $carBrandDto)
    {
        return CarBrand::query()->firstOrCreate($carBrandDto->toArray());
    }

    public function update(CarBrandDto $carBrandDto, CarBrand $carBrand)
    {
        $carBrand->update($carBrandDto->toArray());

        return $carBrand;
    }
}
