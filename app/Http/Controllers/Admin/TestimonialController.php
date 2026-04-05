<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TestimonialRequest;
use App\Services\TestimonialService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TestimonialController extends Controller
{
    protected TestimonialService $service;

    public function __construct(TestimonialService $service)
    {
        $this->service = $service;
    }

    public function index(): View
    {
        $testimonials = $this->service->getAll();
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create(): View
    {
        return view('admin.testimonials.create');
    }

    public function store(TestimonialRequest $request): RedirectResponse
    {
        try {
            $data = $request->all();
            $data['is_active'] = $request->has('is_active');
            $this->service->createTestimonial($data, $request->file('avatar'));
            return redirect()->route('admin.testimonials.index')->with('success', 'Testimoni berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal menambahkan testimoni: ' . $e->getMessage());
        }
    }

    public function edit($id): View
    {
        $testimonial = $this->service->getById($id);
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    public function update(TestimonialRequest $request, $id): RedirectResponse
    {
        try {
            $data = $request->all();
            $data['is_active'] = $request->has('is_active');
            $this->service->updateTestimonial($id, $data, $request->file('avatar'));
            return redirect()->route('admin.testimonials.index')->with('success', 'Testimoni berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal memperbarui testimoni: ' . $e->getMessage());
        }
    }

    public function destroy($id): RedirectResponse
    {
        try {
            $this->service->delete($id);
            return redirect()->route('admin.testimonials.index')->with('success', 'Testimoni berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('admin.testimonials.index')->with('error', 'Gagal menghapus testimoni.');
        }
    }
}
