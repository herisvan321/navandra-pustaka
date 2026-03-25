<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Nevandra') }} Admin</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;0,900;1,400&family=DM+Sans:wght@300;400;500;600&family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased text-text-dark">
    <div class="min-h-screen flex" id="admin-panel">
        <!-- Sidebar -->
        <aside class="w-72 bg-navy border-r border-border flex-shrink-0 hidden lg:flex flex-col relative z-20" id="sidebar">
            <div class="p-8">
                <a href="{{ route('home') }}" class="nav-logo" style="text-decoration: none;">
                    <div class="nav-logo-icon">N</div>
                    <div class="nav-logo-text">
                        <div class="brand">NEVANDRA</div>
                        <div class="sub">MANAGEMENT</div>
                    </div>
                </a>
            </div>

            <nav class="flex-1 px-6 space-y-1.5 mt-2 overflow-y-auto custom-scrollbar pb-8">
                <div class="pt-4 pb-2 px-4 text-[11px] font-bold text-white/20 uppercase tracking-[2px]">Utama</div>
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3.5 px-4 py-3 {{ request()->routeIs('dashboard') ? 'active bg-gold/10 text-gold-light' : 'text-white/60 hover:text-white hover:bg-white/5' }} rounded-xl font-semibold transition-all text-[13px]" style="text-decoration: none;">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    Dashboard
                </a>
                
                <div class="pt-6 pb-2 px-4 text-[11px] font-bold text-white/20 uppercase tracking-[2px]">Katalog & Produk</div>
                <a href="{{ route('books.index') }}" class="flex items-center gap-3.5 px-4 py-3 {{ request()->is('books*') ? 'active bg-gold/10 text-gold-light' : 'text-white/60 hover:text-white hover:bg-white/5' }} rounded-xl font-semibold transition-all text-[13px]" style="text-decoration: none;">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    Belanja Buku
                </a>
                <a href="{{ route('packages.index') }}" class="flex items-center gap-3.5 px-4 py-3 {{ request()->is('packages*') ? 'active bg-gold/10 text-gold-light' : 'text-white/60 hover:text-white hover:bg-white/5' }} rounded-xl font-semibold transition-all text-[13px]" style="text-decoration: none;">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    Paket Penerbitan
                </a>
                <a href="{{ route('publishing-steps.index') }}" class="flex items-center gap-3.5 px-4 py-3 {{ request()->is('publishing-steps*') ? 'active bg-gold/10 text-gold-light' : 'text-white/60 hover:text-white hover:bg-white/5' }} rounded-xl font-semibold transition-all text-[13px]" style="text-decoration: none;">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01m-.01 4h.01"></path></svg>
                    Prosedur Terbit
                </a>

                <div class="pt-6 pb-2 px-4 text-[11px] font-bold text-white/20 uppercase tracking-[2px]">Interaksi & Konten</div>
                <a href="{{ route('news.index') }}" class="flex items-center gap-3.5 px-4 py-3 {{ request()->is('news*') ? 'active bg-gold/10 text-gold-light' : 'text-white/60 hover:text-white hover:bg-white/5' }} rounded-xl font-semibold transition-all text-[13px]" style="text-decoration: none;">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                    Berita Terkini
                </a>
                <a href="{{ route('events.index') }}" class="flex items-center gap-3.5 px-4 py-3 {{ request()->is('events*') ? 'active bg-gold/10 text-gold-light' : 'text-white/60 hover:text-white hover:bg-white/5' }} rounded-xl font-semibold transition-all text-[13px]" style="text-decoration: none;">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path></svg>
                    Event Menulis
                </a>
                <a href="{{ route('gallery.index') }}" class="flex items-center gap-3.5 px-4 py-3 {{ request()->is('gallery*') ? 'active bg-gold/10 text-gold-light' : 'text-white/60 hover:text-white hover:bg-white/5' }} rounded-xl font-semibold transition-all text-[13px]" style="text-decoration: none;">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    Galeri & Dokumentasi
                </a>
                <a href="{{ route('testimonials.index') }}" class="flex items-center gap-3.5 px-4 py-3 {{ request()->is('testimonials*') ? 'active bg-gold/10 text-gold-light' : 'text-white/60 hover:text-white hover:bg-white/5' }} rounded-xl font-semibold transition-all text-[13px]" style="text-decoration: none;">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                    Testimoni
                </a>

                <div class="pt-6 pb-2 px-4 text-[11px] font-bold text-white/20 uppercase tracking-[2px]">Bantuan & Pesan</div>
                <a href="{{ route('faqs.index') }}" class="flex items-center gap-3.5 px-4 py-3 {{ request()->is('faqs*') ? 'active bg-gold/10 text-gold-light' : 'text-white/60 hover:text-white hover:bg-white/5' }} rounded-xl font-semibold transition-all text-[13px]" style="text-decoration: none;">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    FAQ
                </a>
                <a href="{{ route('contacts.index') }}" class="flex items-center gap-3.5 px-4 py-3 {{ request()->is('contacts*') ? 'active bg-gold/10 text-gold-light' : 'text-white/60 hover:text-white hover:bg-white/5' }} rounded-xl font-semibold transition-all text-[13px]" style="text-decoration: none;">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    Inbox Pesan
                </a>
            </nav>

            <div class="p-6 border-t border-white/5 bg-black/10">
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-10 h-10 rounded-full bg-navy-mid border border-gold/20 flex items-center justify-center text-xs font-bold text-white shadow-inner">
                        {{ substr(auth()->user()->name, 0, 2) }}
                    </div>
                    <div class="min-w-0">
                        <p class="text-xs font-bold text-white truncate">{{ auth()->user()->name }}</p>
                        <p class="text-[10px] text-white/40 truncate">{{ auth()->user()->email }}</p>
                    </div>
                </div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full py-2.5 px-4 rounded-xl bg-red-500/10 border border-red-500/20 text-red-400 text-[11px] font-black uppercase tracking-widest hover:bg-red-500 hover:text-white transition-all">
                        Keluar Sistem
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col min-w-0 relative" id="main-wrapper">
            <!-- Header -->
            <header class="h-20 bg-white border-b border-off-white flex items-center justify-between px-10 sticky top-0 z-10 shadow-sm shadow-black/5" id="admin-header">
                <div class="lg:hidden">
                    <button class="text-navy p-2 hover:bg-off-white rounded-lg transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
                    </button>
                </div>

                <div class="flex-1 max-w-xl hidden lg:block">
                    <div class="relative group">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-4 w-4 text-text-light group-focus-within:text-gold transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </span>
                        <input class="block w-full pl-11 pr-4 py-2.5 border border-off-white rounded-2xl bg-off-white/30 text-sm placeholder:text-text-light/50 focus:outline-none focus:ring-4 focus:ring-gold/5 focus:border-gold/50 transition-all" placeholder="Pencarian cepat..." type="text">
                    </div>
                </div>

                <div class="flex items-center gap-6">
                    <div class="flex items-center gap-2">
                        <button class="p-2.5 text-text-light hover:text-gold hover:bg-gold/5 rounded-xl transition-all relative group">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                            <span class="absolute top-2 right-2 w-2 h-2 bg-red-500 rounded-full border-2 border-white group-hover:scale-110 transition-transform"></span>
                        </button>
                        <a href="{{ route('home') }}" target="_blank" class="p-2.5 text-text-light hover:text-gold hover:bg-gold/5 rounded-xl transition-all" title="Lihat Website">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                        </a>
                    </div>
                    
                    <div class="w-px h-8 bg-off-white"></div>
                    
                    <div class="flex items-center gap-4">
                        <div class="text-right hidden sm:block">
                            <p class="text-[13px] font-bold text-navy leading-none">{{ auth()->user()->name }}</p>
                            <p class="text-[10px] text-gold font-bold uppercase tracking-wider mt-1">Administrator</p>
                        </div>
                        <div class="w-11 h-11 bg-gradient-to-br from-navy to-navy-light rounded-2xl flex items-center justify-center text-white text-sm font-black border border-gold/30 shadow-lg shadow-navy/10">
                            {{ substr(auth()->user()->name, 0, 1) }}
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto p-10 bg-white-custom" id="admin-content">
                <div class="max-w-[1400px] mx-auto">
                    @yield('header')
                    <div class="mt-10">
                        @yield('content')
                    </div>
                </div>
                
                <footer class="mt-20 py-8 border-t border-border flex flex-col md:flex-row justify-between items-center gap-4" id="admin-footer">
                    <p class="text-xs text-text-light/60">&copy; {{ date('Y') }} <span class="font-bold text-navy">Nevandra Pustaka Nusantara</span>. Management System v1.0</p>
                    <div class="flex items-center gap-6">
                        <a href="#" class="text-[10px] font-bold text-text-light hover:text-gold transition-colors uppercase tracking-widest" style="text-decoration: none;">Dokumentasi</a>
                        <a href="#" class="text-[10px] font-bold text-text-light hover:text-gold transition-colors uppercase tracking-widest" style="text-decoration: none;">Pusat Bantuan</a>
                    </div>
                </footer>
            </main>
        </div>
    </div>
</body>
</html>
