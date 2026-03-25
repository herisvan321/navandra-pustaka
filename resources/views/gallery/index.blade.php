@extends('layouts.admin')

@section('header')
<div class="section-hero-content">
    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6">
        <div>
            <span class="section-tag">Gallery & Documentation</span>
            <h2 class="section-title">Kelola <span class="gold italic">Galeri Foto</span></h2>
            <p class="section-desc" style="margin: 0; text-align: left; max-width: 600px;">
                Dokumentasi visual kegiatan dan produk Nevandra Pustaka Nusantara.
            </p>
        </div>
        <div class="flex items-center gap-4">
            <a href="{{ route('gallery.create') }}" class="btn-primary" style="text-decoration: none;">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                Tambah Foto Baru
            </a>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="card" style="border-radius: 2.5rem; overflow: hidden;">
    <div class="p-8 border-b border-border flex items-center justify-between bg-white-custom">
        <h3 class="font-display font-black text-navy text-xl">Daftar Galeri</h3>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-white-custom">
                    <th class="px-8 py-5 text-[10px] uppercase tracking-[2px] text-text-light font-black">Foto & Judul</th>
                    <th class="px-8 py-5 text-[10px] uppercase tracking-[2px] text-text-light font-black">Tipe</th>
                    <th class="px-8 py-5 text-[10px] uppercase tracking-[2px] text-text-light font-black">Deskripsi</th>
                    <th class="px-8 py-5 text-[10px] uppercase tracking-[2px] text-text-light font-black text-right">Kelola</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-border">
                @forelse($galleries as $item)
                <tr class="hover:bg-white-custom transition-all group">
                    <td class="px-8 py-6">
                        <div class="flex items-center gap-5">
                            <div class="w-16 h-16 bg-navy rounded-xl border-2 border-gold/10 flex-shrink-0 flex items-center justify-center text-xs text-gold font-black shadow-lg shadow-navy/10 group-hover:border-gold/40 transition-all overflow-hidden">
                                @if($item->image_path)
                                <img src="{{ asset('storage/' . $item->image_path) }}" class="w-full h-full object-cover">
                                @else
                                <span class="text-xl">📸</span>
                                @endif
                            </div>
                            <div>
                                <p class="text-sm font-black text-navy leading-tight mb-1 group-hover:text-gold transition-colors">{{ $item->title }}</p>
                                <p class="text-[10px] font-bold text-text-light/60 uppercase tracking-wider">{{ $item->created_at->format('d M Y') }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-8 py-6">
                        <span class="badge {{ $item->type === 'gallery' ? 'badge-navy' : 'badge-gold' }}">
                            {{ ucfirst($item->type) }}
                        </span>
                    </td>
                    <td class="px-8 py-6">
                        <p class="text-xs text-text-mid line-clamp-2 font-medium max-w-xs">{{ $item->description }}</p>
                    </td>
                    <td class="px-8 py-6 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('gallery.edit', $item) }}" class="btn-outline" style="padding: 8px; border-radius: 12px; text-decoration: none;">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                            </a>
                            <form action="{{ route('gallery.destroy', $item) }}" method="POST" onsubmit="return confirm('Hapus foto ini?')">
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
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                            <p class="text-sm text-text-light font-medium italic">Belum ada foto galeri.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
