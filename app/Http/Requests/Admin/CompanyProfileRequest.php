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
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'instagram_url' => 'nullable|url|max:255',
            'facebook_url' => 'nullable|url|max:255',
            'twitter_url' => 'nullable|url|max:255',
            'about' => 'nullable|string',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'Nama Perusahaan',
            'logo' => 'Logo',
            'email' => 'Email Kontak',
            'phone' => 'Telepon / WhatsApp',
            'address' => 'Alamat',
            'instagram_url' => 'Instagram URL',
            'facebook_url' => 'Facebook URL',
            'twitter_url' => 'Twitter URL',
            'about' => 'Tentang Kami',
        ];
    }
}
