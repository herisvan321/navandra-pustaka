<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
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
        $id = $this->route('book') ?: $this->input('id');

        $rules = [
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'isbn' => 'nullable|string|max:20|unique:books,isbn,' . $id,
            'category' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric|min:0',
            'status' => 'required|string|in:available,out_of_stock,pre_order',
        ];

        if ($this->isMethod('POST')) {
            $rules['cover_image'] = 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048';
        } else {
            $rules['cover_image'] = 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048';
        }

        return $rules;
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes(): array
    {
        return [
            'title' => 'Judul Buku',
            'author' => 'Penulis',
            'category' => 'Kategori',
            'description' => 'Deskripsi',
            'price' => 'Harga',
            'cover_image' => 'Sampul Buku',
            'status' => 'Status',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'required' => ':attribute wajib diisi.',
            'max' => ':attribute tidak boleh lebih dari :max karakter.',
            'image' => ':attribute harus berupa file gambar.',
            'mimes' => ':attribute harus memiliki format: :values.',
            'numeric' => ':attribute harus berupa angka.',
            'min' => ':attribute minimal bernilai :min.',
        ];
    }
}
