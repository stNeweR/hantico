<?php

namespace App\Http\Controllers;

use App\DTO\CarBrandModelDto;
use App\DTO\FilterDto;
use App\Http\Requests\CarBrandModel\CarBrandModelRequest;
use App\Http\Requests\FindByTitleRequest;
use App\Http\Resources\CarBrandModelResource;
use App\Models\CarBrandModel;
use App\Services\CarBrandModelService;
use Illuminate\Http\Request;

class CarBrandModelController extends Controller
{
    public function index(FindByTitleRequest $request, CarBrandModelService $service)
    {
        $carModels = $service->get(FilterDto::fromRequest($request));

        return CarBrandModelResource::collection($carModels);
    }
    public function show(CarBrandModel $carBrandModel)
    {
        return new CarBrandModelResource($carBrandModel);
    }

    public function store(CarBrandModelRequest $request, CarBrandModelService $service)
    {
        $newCarBrandModel = $service->create(CarBrandModelDto::fromRequest($request));

        return new CarBrandModelResource($newCarBrandModel);
    }

    public function update(CarBrandModelRequest $request, CarBrandModelService $service, int $carBrandModelId)
    {
        $updateCarBrand = $service->update(CarBrandModelDto::fromRequest($request), $carBrandModelId);

        return new CarBrandModelResource($updateCarBrand);
    }

    public function destroy(int $carBrandModelId, CarBrandModelService $service)
    {
        $service->delete($carBrandModelId);

        return response()->json([
            'success' => true,
            'message' => 'Car brand model deleted successfully.',
        ], 200);
    }
}
