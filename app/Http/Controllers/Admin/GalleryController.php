<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\GalleryRequest;
use App\Services\GalleryService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GalleryController extends Controller
{
    protected GalleryService $service;

    public function __construct(GalleryService $service)
    {
        $this->service = $service;
    }

    public function index(): View
    {
        $gallery = $this->service->getAll();
        return view('admin.gallery.index', compact('gallery'));
    }

    public function create(): View
    {
        return view('admin.gallery.create');
    }

    public function store(GalleryRequest $request): RedirectResponse
    {
        try {
            $this->service->createGallery($request->all(), $request->file('image'));
            return redirect()->route('admin.gallery.index')->with('success', 'Foto berhasil ditambahkan ke galeri.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal menambahkan foto: ' . $e->getMessage());
        }
    }

    public function edit($id): View
    {
        $item = $this->service->getById($id);
        return view('admin.gallery.edit', compact('item'));
    }

    public function update(GalleryRequest $request, $id): RedirectResponse
    {
        try {
            $this->service->updateGallery($id, $request->all(), $request->file('image'));
            return redirect()->route('admin.gallery.index')->with('success', 'Item galeri berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal memperbarui item galeri: ' . $e->getMessage());
        }
    }

    public function destroy($id): RedirectResponse
    {
        try {
            $this->service->delete($id);
            return redirect()->route('admin.gallery.index')->with('success', 'Item galeri berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('admin.gallery.index')->with('error', 'Gagal menghapus item galeri.');
        }
    }
}
