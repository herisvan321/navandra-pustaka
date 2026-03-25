<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Nevandra Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white-custom font-sans antialiased min-h-screen flex items-center justify-center p-6">
    <div class="max-w-md w-full">
        <div class="text-center mb-10">
            <div class="w-16 h-16 bg-navy mx-auto rounded-2xl flex items-center justify-center text-gold font-display font-black text-3xl mb-6 shadow-custom">
                N
            </div>
            <h1 class="text-3xl font-display font-black text-navy uppercase tracking-tight">Nevandra <span class="text-gold">Admin</span></h1>
            <p class="text-text-light text-sm mt-2">Silakan login untuk mengelola sistem</p>
        </div>

        <div class="card-custom p-8 md:p-10">
            @if($errors->any())
            <div class="mb-6 p-4 bg-red-50 border border-red-100 text-red-600 text-xs font-bold rounded-xl">
                {{ $errors->first() }}
            </div>
            @endif

            <form action="{{ route('login.post') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-navy mb-2">Alamat Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus class="input-custom" placeholder="nama@nevandra.com">
                </div>

                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-navy mb-2">Kata Sandi</label>
                    <input type="password" name="password" required class="input-custom" placeholder="••••••••">
                </div>

                <div class="flex items-center justify-between">
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="remember" class="rounded border-off-white text-gold focus:ring-gold/20">
                        <span class="ml-2 text-xs text-text-mid">Ingat saya</span>
                    </label>
                </div>

                <button type="submit" class="w-full btn-gold py-4">
                    Masuk ke Dashboard
                </button>
            </form>
        </div>

        <p class="text-center text-[10px] text-text-light mt-10 uppercase tracking-[2px]">
            &copy; {{ date('Y') }} Nevandra Pustaka System
        </p>
    </div>
</body>
</html>
