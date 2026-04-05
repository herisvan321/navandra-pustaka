<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthService
{
    /**
     * Handle admin login attempt.
     */
    public function login(array $credentials): bool
    {
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            
            // Periksa role admin (sesuai middleware kita)
            if ($user->role !== 'admin') {
                Auth::logout();
                throw ValidationException::withMessages([
                    'email' => 'Hanya administrator yang diperbolehkan masuk.',
                ]);
            }
            
            session()->regenerate();
            return true;
        }

        throw ValidationException::withMessages([
            'email' => 'Kombinasi email dan kata sandi tidak cocok.',
        ]);
    }

    /**
     * Handle app logout.
     */
    public function logout(): void
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
    }
}
