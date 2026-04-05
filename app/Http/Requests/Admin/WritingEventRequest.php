<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class WritingEventRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'type' => 'required|string|max:100',
            'genre' => 'nullable|string|max:100',
            'description' => 'required|string',
            'deadline' => 'nullable|date',
            'is_active' => 'boolean',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes(): array
    {
        return [
            'title' => 'Judul Event',
            'type' => 'Tipe (Lomba/Antologi/dsb)',
            'genre' => 'Genre',
            'description' => 'Deskripsi',
            'deadline' => 'Batas Waktu',
            'is_active' => 'Status Aktif',
        ];
    }
}
