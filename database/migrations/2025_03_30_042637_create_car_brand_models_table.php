<?php

use App\Models\CarBrand;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('car_brand_models', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->foreignIdFor(CarBrand::class)->constrained()->onDelete('cascade')->index();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_brand_models');
    }
};
