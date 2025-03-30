<?php

namespace Database\Seeders;

use App\Models\CarBrand;
use App\Models\CarBrandModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarBrandModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $carBrands = CarBrand::all();

        // Массив моделей с соответствующими брендами (по названию бренда)
        $models = [
            'Лада' => ['Granta', 'Vesta', 'Aura'],
            'BMW' => ['X5', 'X6', 'M3'],
            'Mazda' => ['6', '3', 'CX-5'],
            'Toyota' => ['Corolla', 'Camry', 'RAV4'],
            'Audi' => ['A4', 'A6', 'Q5'],
        ];

        // Заполняем таблицу car_brand_models
        foreach ($carBrands as $brand) {
            // Находим модели для текущего бренда
            if (isset($models[$brand->title])) {
                foreach ($models[$brand->title] as $modelTitle) {
                    CarBrandModel::create([
                        'title' => $modelTitle,
                        'car_brand_id' => $brand->id, // Используем динамический ID бренда
                    ]);
                }
            }
        }
    }
}