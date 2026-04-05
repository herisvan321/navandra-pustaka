<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\AuthService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AuthController extends Controller
{
    protected AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Tampilkan formulir login.
     */
    public function showLogin(): View
    {
        return view('admin.auth.login');
    }

    /**
     * Tangani pengajuan login.
     */
    public function login(LoginRequest $request): RedirectResponse
    {
        $this->authService->login($request->only('email', 'password'));

        return redirect()->route('admin.dashboard')->with('success', 'Selamat datang kembali, Admin!');
    }

    /**
     * Tangani pengajuan logout.
     */
    public function logout(): RedirectResponse
    {
        $this->authService->logout();

        return redirect()->route('login')->with('success', 'Anda telah berhasil keluar.');
    }
}
