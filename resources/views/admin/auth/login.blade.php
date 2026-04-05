<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin | Nevandra</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        :root {
            --primary-color: #4f46e5;
            --primary-hover: #4338ca;
            --bg-body: #f9fafb;
            --bg-card: #ffffff;
            --text-main: #111827;
            --text-muted: #6b7280;
            --border-color: #e5e7eb;
            --shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1);
        }

        .dark-mode {
            --bg-body: #0f172a;
            --bg-card: #1e293b;
            --text-main: #f1f5f9;
            --text-muted: #94a3b8;
            --border-color: #334155;
            --shadow: 0 20px 25px -5px rgb(0 0 0 / 0.4);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background-color: var(--bg-body);
            color: var(--text-main);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            transition: all 0.3s;
        }

        .login-card {
            background: var(--bg-card);
            padding: 40px;
            border-radius: 20px;
            box-shadow: var(--shadow);
            width: 100%;
            max-width: 400px;
            border: 1px solid var(--border-color);
            position: relative;
            overflow: hidden;
        }

        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo-box {
            width: 60px;
            height: 60px;
            background: var(--primary-color);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 2rem;
            margin: 0 auto 20px;
        }

        h2 {
            font-weight: 700;
            font-size: 1.5rem;
            margin-bottom: 8px;
        }

        p.subtitle {
            color: var(--text-muted);
            font-size: 0.9rem;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-size: 0.85rem;
            font-weight: 500;
            color: var(--text-muted);
        }

        .input-group {
            position: relative;
        }

        .input-group i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
        }

        input {
            width: 100%;
            padding: 12px 15px 12px 45px;
            border: 1px solid var(--border-color);
            border-radius: 10px;
            background: var(--bg-body);
            color: var(--text-main);
            font-size: 0.95rem;
            transition: border-color 0.2s;
        }

        input:focus {
            outline: none;
            border-color: var(--primary-color);
        }

        .btn-login {
            width: 100%;
            padding: 12px;
            background: var(--primary-color);
            color: white;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.2s;
            margin-top: 10px;
        }

        .btn-login:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 0.8rem;
            color: var(--text-muted);
        }

        /* Error Styles */
        .error-msg {
            color: #ef4444;
            font-size: 0.8rem;
            margin-top: 5px;
        }

        .theme-toggle {
            position: fixed;
            top: 20px;
            right: 20px;
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            padding: 10px;
            border-radius: 50%;
            cursor: pointer;
            color: var(--text-main);
            box-shadow: var(--shadow);
            z-index: 100;
        }
    </style>
</head>
<body>

    <button class="theme-toggle" id="themeToggle">
        <i class="fas fa-moon"></i>
    </button>

    <div class="login-card">
        <div class="login-header">
            <div class="logo-box">
                <i class="fas fa-book-open"></i>
            </div>
            <h2>Selamat Datang</h2>
            <p class="subtitle">Panel Administrasi Nevandra Pustaka</p>
        </div>

        <form action="{{ route('login.post') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="email">Alamat Email</label>
                <div class="input-group">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" id="email" placeholder="contoh@penerbit.com" value="{{ old('email') }}" required autofocus>
                </div>
                @error('email')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Kata Sandi</label>
                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" id="password" placeholder="••••••••" required>
                </div>
                @error('password')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn-login">
                Masuk ke Panel <i class="fas fa-arrow-right" style="margin-left: 8px;"></i>
            </button>
        </form>

        <div class="footer">
            &copy; {{ date('Y') }} Nevandra Pustaka Nusantara. All rights reserved.
        </div>
    </div>

    <script>
        const themeToggle = document.getElementById('themeToggle');
        const icon = themeToggle.querySelector('i');

        // Initial Theme
        if (localStorage.getItem('theme') === 'dark') {
            document.body.classList.add('dark-mode');
            icon.className = 'fas fa-sun';
        }

        themeToggle.addEventListener('click', () => {
            document.body.classList.toggle('dark-mode');
            if (document.body.classList.contains('dark-mode')) {
                icon.className = 'fas fa-sun';
                localStorage.setItem('theme', 'dark');
            } else {
                icon.className = 'fas fa-moon';
                localStorage.setItem('theme', 'light');
            }
        });

        // Flash message with SwAl
        @if(session('success'))
            Swal.fire({
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                icon: 'success',
                confirmButtonColor: '#4f46e5'
            });
        @endif
    </script>
</body>
</html>
