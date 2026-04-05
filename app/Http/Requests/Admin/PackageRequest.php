<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PackageRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'tagline' => 'nullable|string|max:255',
            'price' => 'required|numeric|min:0',
            'features' => 'required|array|min:1',
            'features.*' => 'required|string',
            'is_featured' => 'boolean',
            'order' => 'nullable|integer',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes(): array
    {
        return [
            'name' => 'Nama Paket',
            'tagline' => 'Slogan/Tagline',
            'price' => 'Harga',
            'features' => 'Fitur',
            'is_featured' => 'Unggulan',
            'order' => 'Urutan',
        ];
    }
}
