<?php

namespace App\DTO;

use App\Http\Requests\FindByTitleRequest;
use Illuminate\Http\Request;

class FilterDto
{
    public function __construct(
        public ?string $title = null
    ) {}

    public static function fromRequest(FindByTitleRequest $request): self
    {
        $data = $request->validated();

        return new self(
            $data['title'] ?? null
        );
    }
}