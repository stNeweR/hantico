<?php

namespace App\DTO;

use App\Http\Requests\CarBrand\CarBrandRequest;
use Illuminate\Http\Request;

class CarBrandDto
{
    public function __construct(
        public string $title
    ) {}

    public static function fromRequest(CarBrandRequest $request): self
    {
        $data = $request->validated();

        return new self(
            $data['title']
        );
    }

    public function toArray(): array
    {
        return [
            'title' => $this->title,
        ];
    }
}
