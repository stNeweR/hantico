<?php

use App\Http\Controllers\CarBrandController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('car-brands', CarBrandController::class);
