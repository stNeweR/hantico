<?php

namespace Tests\Feature;

use App\Models\CarBrand;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Database\Seeders\CarBrandSeeder;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class CarBrandControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    private CarBrand $testBrand;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(CarBrandSeeder::class);

        $this->testBrand = CarBrand::create(['title' => 'TestBrand']);
    }

    #[Test]
    public function it_can_list_all_car_brands()
    {
        $response = $this->getJson('/api/car-brands');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => ['id', 'title', 'created_at', 'updated_at']
                ]
            ])
            ->assertJsonCount(6, 'data');
    }

    #[Test]
    public function it_can_filter_car_brands_by_title()
    {
        $response = $this->json('GET', '/api/car-brands', ['title' => 'Audi']);

        $response->assertStatus(200)
            ->assertJsonCount(1, 'data')
            ->assertJsonFragment(['title' => 'Audi']);
    }

    #[Test]
    public function it_can_create_a_new_car_brand()
    {
        $payload = ['title' => 'Lexus'];

        $response = $this->postJson('/api/car-brands', $payload);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'data' => ['id', 'title', 'created_at', 'updated_at']
            ])
            ->assertJsonFragment(['title' => 'Lexus']);

        $this->assertDatabaseHas('car_brands', $payload);
        $this->assertDatabaseCount('car_brands', 7);
    }

    #[Test]
    public function it_requires_title_when_creating_car_brand()
    {
        $response = $this->postJson('/api/car-brands', []);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['title']);
    }

    #[Test]
    public function it_can_show_a_single_car_brand()
    {
        $brand = CarBrand::where('title', 'Audi')->first();

        $response = $this->getJson("/api/car-brands/{$brand->id}");

        $response->assertStatus(200)
            ->assertJson([
                'data' => [
                    'id' => $brand->id,
                    'title' => $brand->title
                ]
            ]);
    }

    #[Test]
    public function it_returns_404_if_car_brand_not_found()
    {
        $response = $this->getJson('/api/car-brands/9999');

        $response->assertStatus(404);
    }

    #[Test]
    public function it_can_update_a_car_brand()
    {
        $brand = $this->testBrand;
        $payload = ['title' => 'UpdatedBrand'];

        $response = $this->putJson("/api/car-brands/{$brand->id}", $payload);

        $response->assertStatus(200)
            ->assertJson([
                'data' => [
                    'id' => $brand->id,
                    'title' => 'UpdatedBrand'
                ]
            ]);

        $this->assertDatabaseHas('car_brands', [
            'id' => $brand->id,
            'title' => 'UpdatedBrand'
        ]);
    }

    public function it_requires_title_when_updating_car_brand()
    {
        $brand = CarBrand::first();

        $response = $this->putJson("/api/car-brands/{$brand->id}", []);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['title']);
    }

    public function it_can_delete_a_car_brand()
    {
        $brand = $this->testBrand;

        $response = $this->deleteJson("/api/car-brands/{$brand->id}");

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Car brand deleted successfully.'
            ]);

        $this->assertDatabaseMissing('car_brands', ['id' => $brand->id]);
        $this->assertDatabaseCount('car_brands', 5);
    }

    public function it_returns_404_when_deleting_non_existent_car_brand()
    {
        $response = $this->deleteJson('/api/car-brands/9999');

        $response->assertStatus(404);
    }
}
