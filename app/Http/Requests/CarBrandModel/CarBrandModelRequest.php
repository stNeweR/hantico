<?php

namespace App\Http\Requests\CarBrandModel;

use Illuminate\Foundation\Http\FormRequest;

class CarBrandModelRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' =>  ['required', 'string', 'max:255', 'min:3'],
            'car_brand_id' => ['required', 'integer', 'exists:car_brands,id']
        ];
    }
}
