<?php

namespace App\Http\Controllers;

use App\Events\CompanyProfileUpdated;
use App\Models\CompanyProfile;
use Illuminate\Http\Request;

class CompanyProfileController extends Controller
{
    public function edit()
    {
        $profile = CompanyProfile::first() ?? new CompanyProfile;

        return view('company.edit', compact('profile'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'vision' => 'nullable|string',
            'mission' => 'nullable|string',
            'about' => 'nullable|string',
            'address' => 'nullable|string',
            'phone' => 'nullable|string',
            'email' => 'nullable|email',
        ]);

        $profile = CompanyProfile::first();
        if ($profile) {
            $profile->update($validated);
        } else {
            $profile = CompanyProfile::create($validated);
        }

        event(new CompanyProfileUpdated($profile));

        return redirect()->route('company-profile.edit')
            ->with('success', 'Profil perusahaan berhasil diperbarui.');
    }
}
