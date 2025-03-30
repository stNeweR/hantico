<?php

namespace App\Services;

use App\DTO\CarBrandDto;
use App\DTO\FilterDto;
use App\Repositories\Contracts\CarBrandRepositoryInterface;

class CarBrandService
{
    public function __construct(
        private CarBrandRepositoryInterface $repository
    ) {}

    public function get(FilterDto $filterDto)
    {
        if ($filterDto->title) {
            return $this->repository->findBy([['title', 'like', '%' . $filterDto->title . '%']]);
        }

        return $this->repository->all();
    }

    public function delete(int $carBrandId): bool
    {
        return $this->repository->delete($carBrandId);
    }

    public function create(CarBrandDto $carBrandDto)
    {
        return $this->repository->create($carBrandDto->toArray());
    }

    public function update(CarBrandDto $carBrandDto, int $id)
    {
        return $this->repository->update($id, $carBrandDto->toArray());
    }
}
