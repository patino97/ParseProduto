<?php

namespace App\Http\Requests\Products;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use \Symfony\Component\HttpFoundation\Response;

class CreateProductsRequest extends FormRequest
{
    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator): void
    {
        throw new HttpResponseException(
            response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY)
        );
    }
        
    public function rules(): array
    {
        return [
            'code' => 'nullable|integer',
            'status' => 'nullable|string|max:255',
            'imported_t' => 'nullable|date',
            'url' => 'nullable|url',
            'creator' => 'nullable|string|max:255',
            'created_t' => 'nullable|numeric',
            'last_modified_t' => 'nullable|numeric',
            'product_name' => 'nullable|string|max:255',
            'quantity' => 'nullable|string|max:255', 
            'brands' => 'nullable|string|max:255',
            'categories' => 'nullable|string|max:255',
            'labels' => 'nullable|string|max:255',
            'cities' => 'nullable|string|max:255',
            'purchase_places' => 'nullable|string|max:255',
            'stores' => 'nullable|string|max:255',
            'ingredients_text' => 'nullable|string|max:255',
            'traces' => 'nullable|string|max:255',
            'serving_size' => 'nullable|string|max:255',
            'serving_quantity' => 'nullable|numeric',
            'nutriscore_score' => 'nullable|integer',
            'nutriscore_grade' => 'nullable|string|max:1',
            'main_category' => 'nullable|string|max:255',
            'image_url' => 'nullable|url',
        ];
    }

    public function messages(): array
    {
        return [
        ];
    }
}
