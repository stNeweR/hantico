<?php

namespace Database\Seeders;

use App\Models\CarBrand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarBrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Массив брендов для добавления
        $brands = [
            'Лада',
            'BMW',
            'Mazda',
            'Toyota',
            'Audi',
        ];

        // Добавление брендов в базу данных
        foreach ($brands as $brandName) {
            CarBrand::create(['title' => $brandName]);
        }
    }
}
