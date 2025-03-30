<?php

namespace App\Http\Controllers;

use App\DTO\CarBrandDto;
use App\DTO\CarBrandFilterDto;
use App\Http\Requests\CarBrand\CarBrandRequest;
use App\Http\Requests\FindByTitleRequest;
use App\Http\Resources\CarBrandResource;
use App\Models\CarBrand;
use App\Services\CarBrandService;
use Illuminate\Http\Request;

class CarBrandController extends Controller
{
    public function index(FindByTitleRequest $request, CarBrandService $service)
    {
        $carBrands = $service->get(CarBrandFilterDto::fromRequest($request));

        return CarBrandResource::collection($carBrands);
    }

    public function store(CarBrandRequest $request, CarBrandService $service)
    {
        $newCarBrand = $service->create(CarBrandDto::fromRequest($request));

        return new CarBrandResource($newCarBrand);
    }

    public function show(CarBrand $carBrand)
    {
        return new CarBrandResource($carBrand);
    }

    public function update(CarBrandRequest $request, CarBrandService $service, CarBrand $carBrand) {
        $updateCarBrand = $service->update(CarBrandDto::fromRequest($request), $carBrand);

        return new CarBrandResource($updateCarBrand);
    }

    public function destroy(int $carBrandId, CarBrandService $service)
    {
        $service->delete($carBrandId);

        return response()->json([
            'success' => true,
            'message' => 'Car brand deleted successfully.',
        ], 200);
    }
}
