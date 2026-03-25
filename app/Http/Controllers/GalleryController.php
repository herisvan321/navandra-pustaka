<?php

namespace App\Http\Controllers;

use App\Events\GalleryCreated;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $galleries = Gallery::latest()->paginate(12);

        return view('gallery.index', compact('galleries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('gallery.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|string|in:gallery,documentation',
            'image_path' => 'nullable|string', // Simplifikasi tanpa upload file sungguhan untuk demo
            'description' => 'nullable|string',
            'event_date' => 'nullable|date',
        ]);

        $gallery = Gallery::create($validated);

        event(new GalleryCreated($gallery));

        return redirect()->route('gallery.index')
            ->with('success', 'Item galeri berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Gallery $gallery)
    {
        return view('gallery.show', compact('gallery'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gallery $gallery)
    {
        return view('gallery.edit', compact('gallery'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gallery $gallery)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|string|in:gallery,documentation',
            'image_path' => 'nullable|string',
            'description' => 'nullable|string',
            'event_date' => 'nullable|date',
        ]);

        $gallery->update($validated);

        return redirect()->route('gallery.index')
            ->with('success', 'Item galeri berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gallery $gallery)
    {
        $gallery->delete();

        return redirect()->route('gallery.index')
            ->with('success', 'Item galeri berhasil dihapus.');
    }
}
