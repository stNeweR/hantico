<?php

namespace App\DTO;

use App\Http\Requests\CarBrandModel\CarBrandModelRequest;
use Illuminate\Http\Request;

class CarBrandModelDto
{
    public function __construct(
        public string $title,
        public ?int $carBrandId
    ) {}

    public static function fromRequest(CarBrandModelRequest $request): self
    {
        $data = $request->validated();

        return new self(
            $data['title'],
            $data['car_brand_id'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'car_brand_id' => $this->carBrandId
        ];
    }
}
