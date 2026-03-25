@extends('layouts.admin')

@section('header')
<div class="section-hero-content">
    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6">
        <div>
            <span class="section-tag">Ringkasan Sistem</span>
            <h2 class="section-title">Selamat Datang, <span class="gold italic">Admin</span></h2>
            <p class="section-desc" style="margin: 0; text-align: left; max-width: 600px;">
                Kelola seluruh ekosistem literasi Nevandra Pustaka Nusantara dalam satu panel kendali yang elegan dan efisien.
            </p>
        </div>
        <div class="flex items-center gap-4">
            <a href="{{ route('books.create') }}" class="btn-primary" style="text-decoration: none;">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                Tambah Buku Baru
            </a>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="grid-4">
    <!-- Stat Cards using template card style -->
    <div class="card" style="padding: 32px; position: relative; overflow: hidden;">
        <div class="service-icon" style="margin-bottom: 24px;">
            <svg class="w-7 h-7 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
        </div>
        <h3 class="text-text-light/60 text-[11px] font-black uppercase tracking-[2px] mb-1">Total Koleksi Buku</h3>
        <div class="flex items-baseline gap-2">
            <p class="text-4xl font-display font-black text-navy">{{ number_format($stats['total_books']) }}</p>
            <span class="badge badge-gold">Judul</span>
        </div>
    </div>

    <div class="card" style="padding: 32px; position: relative; overflow: hidden;">
        <div class="service-icon" style="margin-bottom: 24px; background: linear-gradient(135deg, #2e7d32, #4caf50);">
            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path></svg>
        </div>
        <h3 class="text-text-light/60 text-[11px] font-black uppercase tracking-[2px] mb-1">Event Aktif</h3>
        <div class="flex items-baseline gap-2">
            <p class="text-4xl font-display font-black text-navy">{{ $stats['total_events'] }}</p>
            <span class="badge badge-green">Berjalan</span>
        </div>
    </div>

    <div class="card" style="padding: 32px; position: relative; overflow: hidden;">
        <div class="service-icon" style="margin-bottom: 24px; background: linear-gradient(135deg, #1565c0, #1e88e5);">
            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
        </div>
        <h3 class="text-text-light/60 text-[11px] font-black uppercase tracking-[2px] mb-1">Pesan Masuk</h3>
        <div class="flex items-baseline gap-2">
            <p class="text-4xl font-display font-black text-navy">{{ $stats['unread_messages'] }}</p>
            @if($stats['unread_messages'] > 0)
            <span class="badge badge-navy animate-pulse">Baru</span>
            @else
            <span class="badge badge-navy">Inbox</span>
            @endif
        </div>
    </div>

    <div class="card" style="padding: 32px; position: relative; overflow: hidden;">
        <div class="service-icon" style="margin-bottom: 24px;">
            <svg class="w-7 h-7 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
        </div>
        <h3 class="text-text-light/60 text-[11px] font-black uppercase tracking-[2px] mb-1">Testimoni</h3>
        <div class="flex items-baseline gap-2">
            <p class="text-4xl font-display font-black text-navy">{{ $stats['total_testimonials'] }}</p>
            <span class="badge badge-gold">Penulis</span>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-10 mt-12">
    <!-- Latest Books Table using template card style -->
    <div class="lg:col-span-2 card" style="border-radius: 2.5rem; overflow: hidden;">
        <div class="p-8 border-b border-border flex items-center justify-between bg-white-custom">
            <div>
                <h3 class="font-display font-black text-navy text-xl">Koleksi Terbaru</h3>
                <p class="text-xs text-text-light font-medium mt-1">Daftar buku yang baru saja ditambahkan ke sistem.</p>
            </div>
            <a href="{{ route('books.index') }}" class="btn-outline" style="padding: 8px 16px; font-size: 11px; text-decoration: none;">Lihat Semua</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-white-custom">
                        <th class="px-8 py-5 text-[10px] uppercase tracking-[2px] text-text-light font-black">Informasi Buku</th>
                        <th class="px-8 py-5 text-[10px] uppercase tracking-[2px] text-text-light font-black">Kategori</th>
                        <th class="px-8 py-5 text-[10px] uppercase tracking-[2px] text-text-light font-black text-right">Kelola</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border">
                    @forelse($latest_books as $book)
                    <tr class="hover:bg-white-custom transition-all group">
                        <td class="px-8 py-6">
                            <div class="flex items-center gap-5">
                                <div class="w-12 h-16 bg-navy rounded-lg border-2 border-gold/10 flex-shrink-0 flex items-center justify-center text-xs text-gold font-black shadow-lg shadow-navy/10 group-hover:border-gold/40 transition-all">
                                    {{ substr($book->title, 0, 1) }}
                                </div>
                                <div>
                                    <p class="text-sm font-black text-navy leading-tight mb-1 group-hover:text-gold transition-colors">{{ $book->title }}</p>
                                    <p class="text-[11px] font-bold text-text-light/60 uppercase tracking-wider">{{ $book->author }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-8 py-6">
                            <span class="badge badge-gold">
                                {{ $book->category ?? 'Sastra' }}
                            </span>
                        </td>
                        <td class="px-8 py-6 text-right">
                            <a href="{{ route('books.edit', $book) }}" class="btn-outline" style="padding: 8px; border-radius: 12px; text-decoration: none;">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-8 py-20 text-center">
                            <div class="flex flex-col items-center gap-4">
                                <div class="w-16 h-16 bg-white-custom rounded-full flex items-center justify-center text-text-light/20">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                                </div>
                                <p class="text-sm text-text-light font-medium italic">Belum ada buku dalam koleksi.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Latest Messages Sidebar -->
    <div class="space-y-10">
        <div class="card" style="border-radius: 2.5rem; overflow: hidden;">
            <div class="p-8 border-b border-border flex items-center justify-between bg-navy text-white">
                <h3 class="font-display font-black text-lg">Inbox Pesan</h3>
                <span class="badge badge-gold">{{ count($latest_messages) }}</span>
            </div>
            <div class="p-6 space-y-4">
                @forelse($latest_messages as $msg)
                <a href="{{ route('contacts.show', $msg) }}" class="card" style="display: block; padding: 20px; text-decoration: none; border-radius: 1.5rem; {{ !$msg->is_read ? 'background: rgba(201,168,76,0.05); border-color: var(--gold);' : '' }}">
                    <div class="flex justify-between items-start mb-3">
                        <span class="text-[11px] font-black text-navy uppercase tracking-widest">{{ $msg->name }}</span>
                        <span class="text-[9px] font-bold text-text-light/50 uppercase">{{ $msg->created_at->diffForHumans() }}</span>
                    </div>
                    <p class="text-xs text-text-mid/80 line-clamp-2 leading-relaxed font-medium">{{ $msg->message }}</p>
                </a>
                @empty
                <div class="py-12 text-center">
                    <p class="text-xs text-text-light font-medium italic">Inbox kosong.</p>
                </div>
                @endforelse
                <a href="{{ route('contacts.index') }}" class="block w-full py-4 text-center text-[11px] font-black text-navy/40 uppercase tracking-[3px] hover:text-gold transition-colors pt-6 border-t border-border mt-4" style="text-decoration: none;">
                    Buka Semua Pesan →
                </a>
            </div>
        </div>

        <div class="card" style="background: linear-gradient(135deg, var(--navy), var(--navy-light)); border-radius: 2.5rem; padding: 32px; color: white; position: relative; overflow: hidden;">
            <div class="absolute top-0 right-0 p-8 opacity-10">
                <svg class="w-32 h-32" fill="currentColor" viewBox="0 0 24 24"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
            </div>
            <div class="relative">
                <h4 class="font-display font-black text-xl mb-2 text-gold">Butuh Bantuan?</h4>
                <p class="text-xs text-white/60 leading-relaxed font-medium mb-6">Jika Anda mengalami kesulitan dalam mengelola sistem, tim dukungan kami siap membantu Anda.</p>
                <a href="#" class="btn-primary" style="text-decoration: none; background: var(--white); color: var(--navy);">
                    Hubungi Support
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
