<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ContactMessageService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactMessageController extends Controller
{
    protected ContactMessageService $service;

    public function __construct(ContactMessageService $service)
    {
        $this->service = $service;
    }

    public function index(): View
    {
        $messages = $this->service->getAll();
        return view('admin.contacts.index', compact('messages'));
    }

    public function show($id): View
    {
        $message = $this->service->getById($id);
        
        // Optional: mark as read logic if we want to add it later
        
        return view('admin.contacts.show', compact('message'));
    }

    public function destroy($id): RedirectResponse
    {
        try {
            $this->service->delete($id);
            return redirect()->route('admin.contacts.index')->with('success', 'Pesan berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('admin.contacts.index')->with('error', 'Gagal menghapus pesan.');
        }
    }
}
