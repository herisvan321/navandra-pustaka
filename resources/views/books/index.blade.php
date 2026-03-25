@extends('layouts.admin')

@section('header')
<div class="section-hero-content">
    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6">
        <div>
            <span class="section-tag">Book Catalog</span>
            <h2 class="section-title">Kelola <span class="gold italic">Koleksi Buku</span></h2>
            <p class="section-desc" style="margin: 0; text-align: left; max-width: 600px;">
                Daftar lengkap buku yang telah diterbitkan oleh Nevandra Pustaka Nusantara.
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
<div class="card" style="border-radius: 2.5rem; overflow: hidden;">
    <div class="p-8 border-b border-border flex items-center justify-between bg-white-custom">
        <h3 class="font-display font-black text-navy text-xl">Katalog Buku</h3>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-white-custom">
                    <th class="px-8 py-5 text-[10px] uppercase tracking-[2px] text-text-light font-black">Buku & Penulis</th>
                    <th class="px-8 py-5 text-[10px] uppercase tracking-[2px] text-text-light font-black">Kategori</th>
                    <th class="px-8 py-5 text-[10px] uppercase tracking-[2px] text-text-light font-black">Harga</th>
                    <th class="px-8 py-5 text-[10px] uppercase tracking-[2px] text-text-light font-black text-right">Kelola</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-border">
                @forelse($books as $book)
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
                        <span class="badge badge-gold">{{ $book->category ?? 'Sastra' }}</span>
                    </td>
                    <td class="px-8 py-6">
                        <span class="text-sm font-bold text-navy">Rp {{ number_format($book->price, 0, ',', '.') }}</span>
                    </td>
                    <td class="px-8 py-6 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('books.edit', $book) }}" class="btn-outline" style="padding: 8px; border-radius: 12px; text-decoration: none;">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                            </a>
                            <form action="{{ route('books.destroy', $book) }}" method="POST" onsubmit="return confirm('Hapus buku ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-outline" style="padding: 8px; border-radius: 12px; border-color: #fee2e2; color: #ef4444; background: #fff5f5;">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-8 py-20 text-center">
                        <div class="flex flex-col items-center gap-4">
                            <div class="w-16 h-16 bg-white-custom rounded-full flex items-center justify-center text-text-light/20">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                            </div>
                            <p class="text-sm text-text-light font-medium italic">Belum ada koleksi buku.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
