<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class TestimonialRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'role' => 'nullable|string|max:255',
            'content' => 'required|string',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:1024',
            'is_active' => 'boolean',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'Nama Penulis',
            'role' => 'Jabatan/Status',
            'content' => 'Isi Testimoni',
            'avatar' => 'Foto Profil',
        ];
    }
}
