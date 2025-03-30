<?php

namespace App\Repositories;

use App\Repositories\Contracts\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

abstract class BaseRepository implements BaseRepositoryInterface
{
    protected Model $model;

    public function all(array $columns = ['*']): Collection
    {
        return $this->model->get($columns);
    }

    public function find(int $id)
    {
        return $this->model->findOrFail($id);
    }

    public function findBy(array $filters)
    {
        $query = $this->model->query();
    
        foreach ($filters as $filter) {
            if (!is_array($filter)) {
                $query->where(key($filter), '=', current($filter));
                continue;
            }
    
            if (count($filter) === 3) {
                $query->where($filter[0], $filter[1], $filter[2]);
                continue;
            }
    
            if (count($filter) === 1) {
                $query->where(key($filter), '=', current($filter));
            }
        }
    
        return $query->get();
    }

    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    public function update(int $id, array $attributes)
    {
        $model = $this->find($id);
        $model->update($attributes);
        return $model;
    }

    public function delete(int $id): bool
    {
        $model = $this->find($id);
        return $model->delete();
    }
}
