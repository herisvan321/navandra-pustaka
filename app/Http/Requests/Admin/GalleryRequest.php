<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class GalleryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'title' => 'required|string|max:255',
            'category' => 'nullable|string|max:100',
        ];

        if ($this->isMethod('POST')) {
            $rules['image'] = 'required|image|mimes:jpeg,png,jpg,webp|max:5120';
        } else {
            $rules['image'] = 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120';
        }

        return $rules;
    }

    public function attributes(): array
    {
        return [
            'title' => 'Judul Foto',
            'category' => 'Kategori',
            'image' => 'File Gambar',
        ];
    }
}
