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
        $brands = [
            'Лада',
            'BMW',
            'Mazda',
            'Toyota',
            'Audi',
        ];

        foreach ($brands as $brandName) {
            CarBrand::create(['title' => $brandName]);
        }
    }
}
