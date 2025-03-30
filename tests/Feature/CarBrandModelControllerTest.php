<?php

namespace Tests\Feature;

use App\Models\CarBrand;
use App\Models\CarBrandModel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Database\Seeders\CarBrandSeeder;
use Database\Seeders\CarBrandModelSeeder;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class CarBrandModelControllerTest extends TestCase
{
    use RefreshDatabase;

    private CarBrandModel $testModel;

    protected function setUp(): void
    {
        parent::setUp();

        // Загружаем тестовые данные
        $this->seed(CarBrandSeeder::class);
        $this->seed(CarBrandModelSeeder::class);

        // Получаем тестовую модель для операций изменения
        $this->testModel = CarBrandModel::first();
    }

    #[Test]
    public function it_can_list_all_car_models()
    {
        $response = $this->getJson('/api/car-brand-models');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => ['id', 'title', 'car_brand_id', 'created_at', 'updated_at']
                ]
            ])
            ->assertJsonCount(15, 'data'); // 3 модели × 5 брендов
    }

    #[Test]
    public function it_can_filter_car_models_by_title()
    {
        $response = $this->json('GET', '/api/car-brand-models', ['title' => 'Aura']);

        $response->assertStatus(200)
            ->assertJsonCount(1, 'data')
            ->assertJsonFragment(['title' => 'Aura']);
    }

    #[Test]
    public function it_can_show_a_single_car_model()
    {
        $model = CarBrandModel::where('title', 'A6')->first();

        $response = $this->getJson("/api/car-brand-models/{$model->id}");

        $response->assertStatus(200)
            ->assertJson([
                'data' => [
                    'id' => $model->id,
                    'title' => $model->title,
                    'car_brand_id' => $model->car_brand_id
                ]
            ]);
    }

    #[Test]
    public function it_returns_404_if_car_model_not_found()
    {
        $response = $this->getJson('/api/car-brand-models/9999');

        $response->assertStatus(404);
    }

    #[Test]
    public function it_can_create_a_new_car_model()
    {
        $brand = CarBrand::where('title', 'BMW')->first();
        $payload = [
            'title' => 'NewModel',
            'car_brand_id' => $brand->id
        ];

        $response = $this->postJson('/api/car-brand-models', $payload);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'data' => ['id', 'title', 'car_brand_id', 'created_at', 'updated_at']
            ])
            ->assertJsonFragment([
                'title' => 'NewModel',
                'car_brand_id' => $brand->id
            ]);

        $this->assertDatabaseHas('car_brand_models', $payload);
        $this->assertDatabaseCount('car_brand_models', 16); // 15 из сидера + 1 новый
    }

    #[Test]
    public function it_requires_title_and_brand_id_when_creating()
    {
        $response = $this->postJson('/api/car-brand-models', []);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['title', 'car_brand_id']);
    }

    #[Test]
    public function it_validates_brand_exists_when_creating()
    {
        $response = $this->postJson('/api/car-brand-models', [
            'title' => 'NewModel',
            'car_brand_id' => 9999
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['car_brand_id']);
    }

    #[Test]
    public function it_can_update_a_car_model()
    {
        $newBrand = CarBrand::where('title', 'Toyota')->first();
        $payload = [
            'title' => 'UpdatedModel',
            'car_brand_id' => $newBrand->id
        ];

        $response = $this->putJson("/api/car-brand-models/{$this->testModel->id}", $payload);

        $response->assertStatus(200)
            ->assertJson([
                'data' => [
                    'id' => $this->testModel->id,
                    'title' => 'UpdatedModel',
                    'car_brand_id' => $newBrand->id
                ]
            ]);

        $this->assertDatabaseHas('car_brand_models', [
            'id' => $this->testModel->id,
            'title' => 'UpdatedModel',
            'car_brand_id' => $newBrand->id
        ]);
    }

    #[Test]
    public function it_requires_title_and_brand_id_when_updating()
    {
        $response = $this->putJson("/api/car-brand-models/{$this->testModel->id}", []);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['title', 'car_brand_id']);
    }

    #[Test]
    public function it_returns_404_when_updating_non_existent_model()
    {
        $response = $this->putJson('/api/car-brand-models/9999', [
            'title' => 'Updated',
            'car_brand_id' => CarBrand::first()->id
        ]);

        $response->assertStatus(404);
    }

    #[Test]
    public function it_can_delete_a_car_model()
    {
        $response = $this->deleteJson("/api/car-brand-models/{$this->testModel->id}");

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Car brand model deleted successfully.'
            ]);

        $this->assertDatabaseMissing('car_brand_models', ['id' => $this->testModel->id]);
        $this->assertDatabaseCount('car_brand_models', 14); // 15 из сидера - 1 удаленный
    }

    #[Test]
    public function it_returns_404_when_deleting_non_existent_car_model()
    {
        $response = $this->deleteJson('/api/car-brand-models/9999');

        $response->assertStatus(404);
    }
}
