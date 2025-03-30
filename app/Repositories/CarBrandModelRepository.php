<?php

namespace App\Repositories;

use App\Models\CarBrandModel;
use App\Repositories\Contracts\CarBrandModelRepositoryInterface;

class CarBrandModelRepository extends BaseRepository implements CarBrandModelRepositoryInterface
{
    public function __construct()
    {
        $this->model = new CarBrandModel();
    }
}
