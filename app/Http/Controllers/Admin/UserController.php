<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    protected UserService $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function index(): View
    {
        $users = $this->service->getAll();
        return view('admin.users.index', compact('users'));
    }

    public function create(): View
    {
        return view('admin.users.create');
    }

    public function store(UserRequest $request): RedirectResponse
    {
        try {
            $this->service->createUser($request->all());
            return redirect()->route('admin.users.index')->with('success', 'User baru berhasil dibuat.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal membuat user: ' . $e->getMessage());
        }
    }

    public function edit($id): View
    {
        $user = $this->service->getById($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(UserRequest $request, $id): RedirectResponse
    {
        try {
            $this->service->updateUser($id, $request->all());
            return redirect()->route('admin.users.index')->with('success', 'Data user berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal memperbarui user: ' . $e->getMessage());
        }
    }

    public function destroy($id): RedirectResponse
    {
        try {
            $this->service->delete($id);
            return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('admin.users.index')->with('error', 'Gagal menghapus user.');
        }
    }
}
