<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecipesRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
            'people_id' => 'required|integer|exists:people,id',
            'rating' => 'nullable|numeric|min:0|max:5',
            'category_id' => 'required|integer|exists:categories,id',
            'cuisine_id' => 'required|integer|exists:cuisines,id',
            'description' => 'nullable|string',
            'nutrition' => 'nullable',
            'prepare_time' => 'nullable|integer|min:0',
            'total_time' => 'nullable|integer|min:0',
            'cooking_time' => 'nullable|integer|min:0',
            'servings' => 'nullable',
            'steps' => 'required',
            'cost' => 'nullable|numeric|min:0',
            'ingredients'=>'required'

        ];
    }
}
