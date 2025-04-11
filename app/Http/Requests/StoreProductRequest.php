<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|unique:products,name',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'base_price' => 'required|numeric|min:0',
            'override_price' => 'nullable|numeric|min:0',
            'override_start_date' => 'required_with:override_price|date',
            'override_end_date' => 'required_with:override_price|date|after_or_equal:override_start_date',
            'stock_quantity' => 'required|integer|min:1',
            'description_en' => 'required|string',
            'description_es' => 'required|string',
            'tags' => 'nullable|string'
        ];
    }
}
