<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') | Nevandra</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- Anime.js -->
    <script src="https://cdn.jsdelivr.net/npm/animejs/dist/bundles/anime.umd.min.js"></script>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet" href="{{ asset('admin/css/admin.css') }}">
    @yield('styles')

    <script>
        // Apply theme before page renders to prevent flicker
        const currentTheme = localStorage.getItem('theme') || 'light';
        if (currentTheme === 'dark') {
            document.documentElement.classList.add('dark-mode');
        }
    </script>
</head>
<body>

    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <div class="wrapper">
        <!-- Sidebar -->
        <aside id="sidebar">
            <div class="sidebar-header">
                <div class="logo-box"><i class="fas fa-book-open"></i></div>
                <span class="logo-text">NEVANDRA</span>
            </div>
            
            <ul class="sidebar-menu">
                <li class="menu-item">
                    <a href="{{ route('admin.dashboard') }}" class="menu-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="fas fa-th-large"></i>
                        <span class="menu-text">Dashboard</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('admin.books.index') }}" class="menu-link {{ request()->routeIs('admin.books.*') ? 'active' : '' }}">
                        <i class="fas fa-book"></i>
                        <span class="menu-text">Manajemen Buku</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('admin.news.index') }}" class="menu-link {{ request()->routeIs('admin.news.*') ? 'active' : '' }}">
                        <i class="fas fa-newspaper"></i>
                        <span class="menu-text">Berita & Artikel</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('admin.packages.index') }}" class="menu-link {{ request()->routeIs('admin.packages.*') ? 'active' : '' }}">
                        <i class="fas fa-box"></i>
                        <span class="menu-text">Paket Penerbitan</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('admin.events.index') }}" class="menu-link {{ request()->routeIs('admin.events.*') ? 'active' : '' }}">
                        <i class="fas fa-calendar-alt"></i>
                        <span class="menu-text">Event Menulis</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('admin.publishing-steps.index') }}" class="menu-link {{ request()->routeIs('admin.publishing-steps.*') ? 'active' : '' }}">
                        <i class="fas fa-tasks"></i>
                        <span class="menu-text">Alur Penerbitan</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('admin.gallery.index') }}" class="menu-link {{ request()->routeIs('admin.gallery.*') ? 'active' : '' }}">
                        <i class="fas fa-images"></i>
                        <span class="menu-text">Galeri Foto</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('admin.testimonials.index') }}" class="menu-link {{ request()->routeIs('admin.testimonials.*') ? 'active' : '' }}">
                        <i class="fas fa-quote-left"></i>
                        <span class="menu-text">Testimonial</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('admin.faqs.index') }}" class="menu-link {{ request()->routeIs('admin.faqs.*') ? 'active' : '' }}">
                        <i class="fas fa-question-circle"></i>
                        <span class="menu-text">FAQ</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('admin.contacts.index') }}" class="menu-link {{ request()->routeIs('admin.contacts.*') ? 'active' : '' }}">
                        <i class="fas fa-envelope"></i>
                        <span class="menu-text">Pesan Masuk</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('admin.company-profile.edit') }}" class="menu-link {{ request()->routeIs('admin.company-profile.*') ? 'active' : '' }}">
                        <i class="fas fa-building"></i>
                        <span class="menu-text">Profil Perusahaan</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('admin.users.index') }}" class="menu-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                        <i class="fas fa-user-shield"></i>
                        <span class="menu-text">Manajemen User</span>
                    </a>
                </li>
            </ul>

            <div style="position: absolute; bottom: 20px; width: 100%; padding: 0 10px;">
                <form action="{{ route('logout') }}" method="POST" id="logoutForm">
                    @csrf
                    <a href="#" class="menu-link" id="logoutBtn">
                        <i class="fas fa-sign-out-alt"></i>
                        <span class="menu-text">Keluar</span>
                    </a>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main>
            <!-- Topbar -->
            <header>
                <div class="topbar-left">
                    <button class="toggle-btn" id="sidebarToggle">
                        <i class="fas fa-bars"></i>
                    </button>
                    <h3 style="font-size: 1.1rem;">@yield('page_title', 'Admin Dashboard')</h3>
                </div>

                <div class="topbar-right">
                    <button class="action-btn" id="themeToggle" data-tooltip="Ganti Tema">
                        <i class="fas fa-moon"></i>
                    </button>
                    <button class="action-btn" id="fullscreenToggle" data-tooltip="Layar Penuh">
                        <i class="fas fa-expand"></i>
                    </button>
                    <div class="action-btn" data-tooltip="Notifikasi">
                        <i class="fas fa-bell"></i>
                        <span class="badge-notif">0</span>
                    </div>
                    <div style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                        <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=4f46e5&color=fff" alt="Profile" style="width: 35px; border-radius: 50%;">
                        <span style="font-weight: 600; font-size: 0.9rem;" class="mobile-hide">{{ Auth::user()->name }}</span>
                    </div>
                </div>
            </header>

            @yield('content')
        </main>
    </div>

    <script src="{{ asset('admin/js/admin.js') }}"></script>
    <script>
        // Additional Logic for Logout and SwAl
        document.getElementById('logoutBtn').addEventListener('click', (e) => {
            e.preventDefault();
            Swal.fire({
                title: 'Keluar Sesi?',
                text: "Anda akan diarahkan ke halaman login.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#4f46e5'
            }).then((result) => {
                if (result.isConfirmed) document.getElementById('logoutForm').submit();
            });
        });

        @if(session('success'))
            Swal.fire({
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                icon: 'success',
                confirmButtonColor: '#4f46e5'
            });
        @endif

        @if(session('error'))
            Swal.fire({
                title: 'Gagal!',
                text: "{{ session('error') }}",
                icon: 'error',
                confirmButtonColor: '#ef4444'
            });
        @endif
    </script>
    @yield('scripts')
</body>
</html>
