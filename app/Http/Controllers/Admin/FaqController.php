<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FaqRequest;
use App\Services\FaqService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FaqController extends Controller
{
    protected FaqService $service;

    public function __construct(FaqService $service)
    {
        $this->service = $service;
    }

    public function index(): View
    {
        $faqs = $this->service->getAll();
        return view('admin.faqs.index', compact('faqs'));
    }

    public function create(): View
    {
        return view('admin.faqs.create');
    }

    public function store(FaqRequest $request): RedirectResponse
    {
        try {
            $data = $request->all();
            $data['is_active'] = $request->has('is_active');
            $this->service->create($data);
            return redirect()->route('admin.faqs.index')->with('success', 'FAQ berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal menambahkan FAQ: ' . $e->getMessage());
        }
    }

    public function edit($id): View
    {
        $faq = $this->service->getById($id);
        return view('admin.faqs.edit', compact('faq'));
    }

    public function update(FaqRequest $request, $id): RedirectResponse
    {
        try {
            $data = $request->all();
            $data['is_active'] = $request->has('is_active');
            $this->service->update($id, $data);
            return redirect()->route('admin.faqs.index')->with('success', 'FAQ berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal memperbarui FAQ: ' . $e->getMessage());
        }
    }

    public function destroy($id): RedirectResponse
    {
        try {
            $this->service->delete($id);
            return redirect()->route('admin.faqs.index')->with('success', 'FAQ berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('admin.faqs.index')->with('error', 'Gagal menghapus FAQ.');
        }
    }
}
