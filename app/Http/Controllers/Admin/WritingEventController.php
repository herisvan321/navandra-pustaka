<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\WritingEventRequest;
use App\Services\WritingEventService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class WritingEventController extends Controller
{
    protected WritingEventService $service;

    public function __construct(WritingEventService $service)
    {
        $this->service = $service;
    }

    public function index(): View
    {
        $events = $this->service->getAll();
        return view('admin.events.index', compact('events'));
    }

    public function create(): View
    {
        return view('admin.events.create');
    }

    public function store(WritingEventRequest $request): RedirectResponse
    {
        try {
            $data = $request->all();
            $data['is_active'] = $request->has('is_active');
            $this->service->create($data);
            return redirect()->route('admin.events.index')->with('success', 'Event berhasil dibuat.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal membuat event: ' . $e->getMessage());
        }
    }

    public function edit($id): View
    {
        $event = $this->service->getById($id);
        return view('admin.events.edit', compact('event'));
    }

    public function update(WritingEventRequest $request, $id): RedirectResponse
    {
        try {
            $data = $request->all();
            $data['is_active'] = $request->has('is_active');
            $this->service->update($id, $data);
            return redirect()->route('admin.events.index')->with('success', 'Event berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal memperbarui event: ' . $e->getMessage());
        }
    }

    public function destroy($id): RedirectResponse
    {
        try {
            $this->service->delete($id);
            return redirect()->route('admin.events.index')->with('success', 'Event berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('admin.events.index')->with('error', 'Gagal menghapus event.');
        }
    }
}
