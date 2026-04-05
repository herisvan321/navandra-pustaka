<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\NewsRequest;
use App\Services\NewsService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NewsController extends Controller
{
    protected NewsService $service;

    public function __construct(NewsService $service)
    {
        $this->service = $service;
    }

    public function index(): View
    {
        $news = $this->service->getAll();
        return view('admin.news.index', compact('news'));
    }

    public function create(): View
    {
        return view('admin.news.create');
    }

    public function store(NewsRequest $request): RedirectResponse
    {
        try {
            $data = $request->validated();
            $data['is_published'] = $request->status === 'published';
            $data['published_at'] = $data['is_published'] ? now() : null;
            
            $this->service->createNews($data, $request->file('image'));
            return redirect()->route('admin.news.index')->with('success', 'Berita berhasil diterbitkan.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal menerbitkan berita: ' . $e->getMessage());
        }
    }

    public function edit($id): View
    {
        $news = $this->service->getById($id);
        return view('admin.news.edit', compact('news'));
    }

    public function update(NewsRequest $request, $id): RedirectResponse
    {
        try {
            $data = $request->validated();
            $data['is_published'] = $request->status === 'published';
            
            $news = $this->service->getById($id);
            if ($data['is_published'] && !$news->published_at) {
                $data['published_at'] = now();
            } elseif (!$data['is_published']) {
                $data['published_at'] = null;
            }

            $this->service->updateNews($id, $data, $request->file('image'));
            return redirect()->route('admin.news.index')->with('success', 'Berita berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal memperbarui berita: ' . $e->getMessage());
        }
    }

    public function destroy($id): RedirectResponse
    {
        try {
            $this->service->delete($id);
            return redirect()->route('admin.news.index')->with('success', 'Berita berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('admin.news.index')->with('error', 'Gagal menghapus berita.');
        }
    }
}
