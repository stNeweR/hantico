<?php

namespace App\Repositories\Contracts;

use Illuminate\Support\Collection;

interface BaseRepositoryInterface
{
    public function all(array $columns = ['*']): Collection;
    public function find(int $id);
    public function findBy(array $filters);
    public function create(array $attributes);
    public function update(int $id, array $attributes);
    public function delete(int $id): bool;
}
