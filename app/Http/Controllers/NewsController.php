<?php

namespace App\Http\Controllers;

use App\Events\NewsCreated;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $news = News::latest()->paginate(10);

        return view('news.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('news.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image_path' => 'nullable|string',
            'is_published' => 'nullable|boolean',
        ]);

        if ($request->has('is_published') && $request->is_published) {
            $validated['published_at'] = now();
        }

        $news = News::create($validated);

        event(new NewsCreated($news));

        return redirect()->route('news.index')
            ->with('success', 'Berita berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(News $news)
    {
        return view('news.show', compact('news'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(News $news)
    {
        return view('news.edit', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, News $news)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image_path' => 'nullable|string',
            'is_published' => 'nullable|boolean',
        ]);

        if ($request->has('is_published') && $request->is_published && ! $news->is_published) {
            $validated['published_at'] = now();
        } elseif (! $request->has('is_published') || ! $request->is_published) {
            $validated['published_at'] = null;
            $validated['is_published'] = false;
        }

        $news->update($validated);

        return redirect()->route('news.index')
            ->with('success', 'Berita berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news)
    {
        $news->delete();

        return redirect()->route('news.index')
            ->with('success', 'Berita berhasil dihapus.');
    }
}
