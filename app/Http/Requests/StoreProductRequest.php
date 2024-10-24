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
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    // public function rules(): array
    // {
    //     return [
    //         //
    //     ];
    // }
    public function rules()
    {
        return [
            'name' => 'required',
            'price' => 'required|numeric',
            'product_variants' => 'required|array|min:1',
            'product_variants.*.size' => 'required',
            'product_variants.*.color' => 'required',
            'product_variants.*.quantity' => 'required|numeric',
        ];
    }
}