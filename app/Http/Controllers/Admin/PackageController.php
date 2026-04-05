<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PackageRequest;
use App\Services\PackageService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PackageController extends Controller
{
    protected PackageService $service;

    public function __construct(PackageService $service)
    {
        $this->service = $service;
    }

    public function index(): View
    {
        $packages = $this->service->getAll();
        return view('admin.packages.index', compact('packages'));
    }

    public function create(): View
    {
        return view('admin.packages.create');
    }

    public function store(PackageRequest $request): RedirectResponse
    {
        try {
            $data = $request->all();
            $data['is_featured'] = $request->has('is_featured');
            $this->service->createPackage($data);
            return redirect()->route('admin.packages.index')->with('success', 'Paket berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal menambahkan paket: ' . $e->getMessage());
        }
    }

    public function edit($id): View
    {
        $package = $this->service->getById($id);
        if ($package->features && is_string($package->features)) {
            $package->features = json_decode($package->features, true);
        }
        return view('admin.packages.edit', compact('package'));
    }

    public function update(PackageRequest $request, $id): RedirectResponse
    {
        try {
            $data = $request->all();
            $data['is_featured'] = $request->has('is_featured');
            $this->service->updatePackage($id, $data);
            return redirect()->route('admin.packages.index')->with('success', 'Paket berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal memperbarui paket: ' . $e->getMessage());
        }
    }

    public function destroy($id): RedirectResponse
    {
        try {
            $this->service->delete($id);
            return redirect()->route('admin.packages.index')->with('success', 'Paket berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('admin.packages.index')->with('error', 'Gagal menghapus paket.');
        }
    }
}
