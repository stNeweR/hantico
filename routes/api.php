<?php

use App\Http\Controllers\CarBrandController;
use App\Http\Controllers\CarBrandModelController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('car-brands', CarBrandController::class);

Route::apiResource('car-brand-models', CarBrandModelController::class);