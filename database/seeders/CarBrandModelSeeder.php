<?php

namespace Database\Seeders;

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
        // Массив моделей машин с привязкой к брендам
        $models = [
            [
                'title' => 'Granta',
                'car_brand_id' => 1,
            ],
            [
                'title' => 'Vesta',
                'car_brand_id' => 1,
            ],
            [
                'title' => 'Aura',
                'car_brand_id' => 1,
            ],
            [
                'title' => 'X5',
                'car_brand_id' => 2,
            ],
            [
                'title' => 'X6',
                'car_brand_id' => 2,
            ],
            [
                'title' => 'M3',
                'car_brand_id' => 2,
            ],
            [
                'title' => '6',
                'car_brand_id' => 3,
            ],
            [
                'title' => '3',
                'car_brand_id' => 3,
            ],
            [
                'title' => 'CX-5',
                'car_brand_id' => 3,
            ],
            [
                'title' => 'Corolla',
                'car_brand_id' => 4,
            ],
            [
                'title' => 'Camry',
                'car_brand_id' => 4,
            ],
            [
                'title' => 'RAV4',
                'car_brand_id' => 4,
            ],
            [
                'title' => 'A4',
                'car_brand_id' => 5,
            ],
            [
                'title' => 'A6',
                'car_brand_id' => 5,
            ],
            [
                'title' => 'Q5',
                'car_brand_id' => 5,
            ],
        ];


        foreach ($models as $modelData) {
            CarBrandModel::create($modelData);
        }
    }
}
