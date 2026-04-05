<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CompanyProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'tagline' => 'nullable|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'whatsapp' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'facebook' => 'nullable|url|max:255',
            'instagram' => 'nullable|url|max:255',
            'twitter' => 'nullable|url|max:255',
            'youtube' => 'nullable|url|max:255',
            'about_footer' => 'nullable|string|max:500',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'Nama Perusahaan',
            'tagline' => 'Slogan',
            'logo' => 'Logo',
            'email' => 'Email Kontak',
            'phone' => 'Telepon',
            'whatsapp' => 'WhatsApp',
            'address' => 'Alamat',
            'about_footer' => 'Tentang Kami (Footer)',
        ];
    }
}
