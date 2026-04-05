<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BookRequest;
use App\Services\BookService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BookController extends Controller
{
    protected BookService $service;

    public function __construct(BookService $service)
    {
        $this->service = $service;
    }

    public function index(): View
    {
        $books = $this->service->getAll();
        return view('admin.books.index', compact('books'));
    }

    public function create(): View
    {
        return view('admin.books.create');
    }

    public function store(BookRequest $request): RedirectResponse
    {
        try {
            $this->service->createBook($request->except('cover_image'), $request->file('cover_image'));
            return redirect()->route('admin.books.index')->with('success', 'Buku berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal menambahkan buku: ' . $e->getMessage());
        }
    }

    public function edit($id): View
    {
        $book = $this->service->getById($id);
        return view('admin.books.edit', compact('book'));
    }

    public function update(BookRequest $request, $id): RedirectResponse
    {
        try {
            $this->service->updateBook($id, $request->except('cover_image'), $request->file('cover_image'));
            return redirect()->route('admin.books.index')->with('success', 'Data buku berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal memperbarui buku: ' . $e->getMessage());
        }
    }

    public function destroy($id): RedirectResponse
    {
        try {
            $this->service->delete($id);
            return redirect()->route('admin.books.index')->with('success', 'Buku berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('admin.books.index')->with('error', 'Gagal menghapus buku.');
        }
    }
}
