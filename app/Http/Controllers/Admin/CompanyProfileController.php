<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CompanyProfileRequest;
use App\Services\CompanyProfileService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CompanyProfileController extends Controller
{
    protected CompanyProfileService $service;

    public function __construct(CompanyProfileService $service)
    {
        $this->service = $service;
    }

    public function edit(): View
    {
        $profile = $this->service->getProfile();
        return view('admin.company-profile.index', compact('profile'));
    }

    public function update(CompanyProfileRequest $request): RedirectResponse
    {
        try {
            $this->service->updateProfile($request->all(), $request->file('logo'));
            return redirect()->route('admin.company-profile.edit')->with('success', 'Profil perusahaan berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal memperbarui profil: ' . $e->getMessage());
        }
    }
}
