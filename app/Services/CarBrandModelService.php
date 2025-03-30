<?php

namespace App\Services;

use App\DTO\CarBrandModelDto;
use App\Dto\FilterDto;
use App\Repositories\Contracts\CarBrandModelRepositoryInterface;

class CarBrandModelService
{
    public function __construct(
        private CarBrandModelRepositoryInterface $repository
    ) {}

    public function get(FilterDto $filterDto)
    {
        if ($filterDto->title) {
            return $this->repository->findBy([['title', 'like', '%' . $filterDto->title . '%']]);
        }

        return $this->repository->all();
    }

    public function create(CarBrandModelDto $carBrandModel)
    {
        return $this->repository->create($carBrandModel->toArray());
    }

    public function update(CarBrandModelDto $carBrandModelDto, int $id)
    {
        return $this->repository->update($id, $carBrandModelDto->toArray());
    }

    public function delete(int $carBrandModelId)
    {
        return $this->repository->delete($carBrandModelId);
    }
}
