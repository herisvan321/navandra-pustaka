<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Nevandra Pustaka Nusantara' }} – Penerbit Terpercaya di Nusantara</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;0,900;1,400&family=DM+Sans:wght@300;400;500;600&family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased text-text-dark">
    <nav id="navbar">
        <div class="nav-container">
            <a href="{{ route('home') }}" class="nav-logo">
                <div class="nav-logo-icon">N</div>
                <div class="nav-logo-text">
                    <div class="brand">NEVANDRA</div>
                    <div class="sub">PUSTAKA NUSANTARA</div>
                </div>
            </a>

            <ul class="nav-links hidden md:flex">
                <li><a href="{{ route('home') }}" class="{{ request()->is('/') ? 'active' : '' }}">Home</a></li>
                <li><a href="{{ route('public.about') }}" class="{{ request()->is('tentang-kami') ? 'active' : '' }}">Tentang Kami</a></li>
                <li><a href="{{ route('public.packages') }}" class="{{ request()->is('paket-penerbitan') ? 'active' : '' }}">Paket</a></li>
                <li><a href="{{ route('public.steps') }}" class="{{ request()->is('terbitkan-buku') ? 'active' : '' }}">Terbitkan</a></li>
                <li><a href="{{ route('public.books') }}" class="{{ request()->is('belanja-buku') ? 'active' : '' }}">Belanja</a></li>
                <li><a href="{{ route('public.events') }}" class="{{ request()->is('event-menulis') ? 'active' : '' }}">Event</a></li>
                <li><a href="{{ route('public.faq') }}" class="{{ request()->is('faq') ? 'active' : '' }}">FAQ</a></li>
                <li><a href="{{ route('public.contact') }}" class="nav-cta">Hubungi Kami</a></li>
            </ul>

            <button class="hamburger flex md:hidden" onclick="toggleMobile()">
                <span></span><span></span><span></span>
            </button>
        </div>
    </nav>

    <div class="mobile-menu" id="mobileMenu">
        <a href="{{ route('home') }}">Home</a>
        <a href="{{ route('public.about') }}">Tentang Kami</a>
        <a href="{{ route('public.packages') }}">Paket Penerbitan</a>
        <a href="{{ route('public.steps') }}">Terbitkan Buku</a>
        <a href="{{ route('public.books') }}">Belanja Buku</a>
        <a href="{{ route('public.events') }}">Event Menulis</a>
        <a href="{{ route('public.faq') }}">FAQ</a>
        <a href="{{ route('public.contact') }}">Hubungi Kami</a>
    </div>

    <main>
        @yield('content')
    </main>

    <footer>
        <div class="footer-grid">
            <div>
                <div class="nav-logo" style="margin-bottom: 24px;">
                    <div class="nav-logo-icon">N</div>
                    <div class="nav-logo-text">
                        <div class="brand">NEVANDRA</div>
                        <div class="sub">PUSTAKA NUSANTARA</div>
                    </div>
                </div>
                <p style="color: rgba(250,250,248,0.6); font-size: 14px; line-height: 1.6; margin-bottom: 24px;">
                    Nevandra Pustaka Nusantara adalah mitra terpercaya bagi para penulis dan institusi dalam mewujudkan karya literasi berkualitas.
                </p>
            </div>
            <div>
                <h4 style="color: var(--white); font-family: 'Playfair Display', serif; margin-bottom: 24px;">Layanan</h4>
                <ul style="list-style: none; display: grid; gap: 12px;">
                    <li><a href="{{ route('public.packages') }}" style="color: rgba(250,250,248,0.6); text-decoration: none; font-size: 14px;">Paket Penerbitan</a></li>
                    <li><a href="{{ route('public.steps') }}" style="color: rgba(250,250,248,0.6); text-decoration: none; font-size: 14px;">Prosedur Terbit</a></li>
                    <li><a href="{{ route('public.books') }}" style="color: rgba(250,250,248,0.6); text-decoration: none; font-size: 14px;">Toko Buku Online</a></li>
                    <li><a href="{{ route('public.events') }}" style="color: rgba(250,250,248,0.6); text-decoration: none; font-size: 14px;">Event Menulis</a></li>
                </ul>
            </div>
            <div>
                <h4 style="color: var(--white); font-family: 'Playfair Display', serif; margin-bottom: 24px;">Perusahaan</h4>
                <ul style="list-style: none; display: grid; gap: 12px;">
                    <li><a href="{{ route('public.about') }}" style="color: rgba(250,250,248,0.6); text-decoration: none; font-size: 14px;">Tentang Kami</a></li>
                    <li><a href="{{ route('public.gallery') }}" style="color: rgba(250,250,248,0.6); text-decoration: none; font-size: 14px;">Galeri Foto</a></li>
                    <li><a href="{{ route('public.testimonials') }}" style="color: rgba(250,250,248,0.6); text-decoration: none; font-size: 14px;">Testimoni Penulis</a></li>
                    <li><a href="{{ route('public.documentation') }}" style="color: rgba(250,250,248,0.6); text-decoration: none; font-size: 14px;">Dokumentasi Event</a></li>
                </ul>
            </div>
            <div>
                <h4 style="color: var(--white); font-family: 'Playfair Display', serif; margin-bottom: 24px;">Kontak</h4>
                <ul style="list-style: none; display: grid; gap: 16px;">
                    <li style="display: flex; gap: 12px; color: rgba(250,250,248,0.6); font-size: 14px;">
                        <span>📍</span>
                        Jl. Kalumbuk RT003/RW003, Kuranji, Padang
                    </li>
                    <li style="display: flex; gap: 12px; color: rgba(250,250,248,0.6); font-size: 14px;">
                        <span>📱</span>
                        <a href="https://wa.me/6285814609558" style="color: inherit; text-decoration: none;">085814609558</a>
                    </li>
                    <li style="display: flex; gap: 12px; color: rgba(250,250,248,0.6); font-size: 14px;">
                        <span>✉️</span>
                        <a href="mailto:Nevandra.press@gmail.com" style="color: inherit; text-decoration: none;">Nevandra.press@gmail.com</a>
                    </li>
                </ul>
            </div>
        </div>
        <div style="max-width: 1280px; margin: 0 auto; padding-top: 32px; border-top: 1px solid rgba(201,168,76,0.1); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px;">
            <p style="color: rgba(250,250,248,0.4); font-size: 12px;">&copy; 2025 <span style="color: var(--gold);">CV Nevandra Pustaka Nusantara</span>. Hak Cipta Dilindungi.</p>
            <p style="color: rgba(250,250,248,0.4); font-size: 12px;">Kota Padang, Sumatera Barat, Indonesia</p>
        </div>
    </footer>

    <script>
        function toggleMobile() {
            document.getElementById('mobileMenu').classList.toggle('open');
        }

        function toggleFaq(el) {
            el.parentElement.classList.toggle('open');
        }

        window.addEventListener('scroll', () => {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 50) {
                navbar.style.padding = '4px 0';
                navbar.style.background = 'rgba(11, 29, 58, 0.98)';
            } else {
                navbar.style.padding = '0';
                navbar.style.background = 'rgba(11, 29, 58, 0.97)';
            }
        });
    </script>
</body>
</html>