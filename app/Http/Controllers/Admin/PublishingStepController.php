<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PublishingStepRequest;
use App\Services\PublishingStepService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PublishingStepController extends Controller
{
    protected PublishingStepService $service;

    public function __construct(PublishingStepService $service)
    {
        $this->service = $service;
    }

    public function index(): View
    {
        $steps = $this->service->getAll();
        return view('admin.publishing-steps.index', compact('steps'));
    }

    public function create(): View
    {
        return view('admin.publishing-steps.create');
    }

    public function store(PublishingStepRequest $request): RedirectResponse
    {
        try {
            $this->service->create($request->all());
            return redirect()->route('admin.publishing-steps.index')->with('success', 'Langkah penerbitan berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal menambahkan langkah: ' . $e->getMessage());
        }
    }

    public function edit($id): View
    {
        $step = $this->service->getById($id);
        return view('admin.publishing-steps.edit', compact('step'));
    }

    public function update(PublishingStepRequest $request, $id): RedirectResponse
    {
        try {
            $this->service->update($id, $request->all());
            return redirect()->route('admin.publishing-steps.index')->with('success', 'Langkah penerbitan berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal memperbarui langkah: ' . $e->getMessage());
        }
    }

    public function destroy($id): RedirectResponse
    {
        try {
            $this->service->delete($id);
            return redirect()->route('admin.publishing-steps.index')->with('success', 'Langkah penerbitan berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('admin.publishing-steps.index')->with('error', 'Gagal menghapus langkah.');
        }
    }
}
