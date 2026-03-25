@extends('layouts.admin')

@section('header')
<div class="section-hero-content">
    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6">
        <div>
            <span class="section-tag">Testimonials</span>
            <h2 class="section-title">Kelola <span class="gold italic">Testimoni</span></h2>
            <p class="section-desc" style="margin: 0; text-align: left; max-width: 600px;">
                Ulasan, kesan, dan pesan dari para penulis atau pelanggan Nevandra Pustaka Nusantara.
            </p>
        </div>
        <div class="flex items-center gap-4">
            <a href="{{ route('testimonials.create') }}" class="btn-primary" style="text-decoration: none;">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                Tambah Testimoni
            </a>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="card" style="border-radius: 2.5rem; overflow: hidden;">
    <div class="p-8 border-b border-border flex items-center justify-between bg-white-custom">
        <h3 class="font-display font-black text-navy text-xl">Daftar Testimoni</h3>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-white-custom">
                    <th class="px-8 py-5 text-[10px] uppercase tracking-[2px] text-text-light font-black">Penulis & Peran</th>
                    <th class="px-8 py-5 text-[10px] uppercase tracking-[2px] text-text-light font-black">Rating</th>
                    <th class="px-8 py-5 text-[10px] uppercase tracking-[2px] text-text-light font-black">Pesan</th>
                    <th class="px-8 py-5 text-[10px] uppercase tracking-[2px] text-text-light font-black text-right">Kelola</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-border">
                @forelse($testimonials as $testi)
                <tr class="hover:bg-white-custom transition-all group">
                    <td class="px-8 py-6">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-full bg-navy flex items-center justify-center text-white text-xs font-bold shadow-lg shadow-navy/10 group-hover:bg-gold group-hover:text-navy transition-all">
                                {{ substr($testi->name, 0, 1) }}
                            </div>
                            <div>
                                <p class="text-sm font-black text-navy leading-tight mb-1 group-hover:text-gold transition-colors">{{ $testi->name }}</p>
                                <p class="text-[10px] font-bold text-text-light/60 uppercase tracking-wider">{{ $testi->role }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-8 py-6">
                        <div class="stars" style="margin: 0; font-size: 12px;">
                            @for($i = 0; $i < 5; $i++)
                                <span class="{{ $i < $testi->rating ? 'text-amber-400' : 'text-gray-300' }}">★</span>
                            @endfor
                        </div>
                    </td>
                    <td class="px-8 py-6">
                        <p class="text-xs text-text-mid line-clamp-2 font-medium max-w-xs italic font-serif">"{{ $testi->content }}"</p>
                    </td>
                    <td class="px-8 py-6 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('testimonials.edit', $testi) }}" class="btn-outline" style="padding: 8px; border-radius: 12px; text-decoration: none;">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                            </a>
                            <form action="{{ route('testimonials.destroy', $testi) }}" method="POST" onsubmit="return confirm('Hapus testimoni ini?')">
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
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                            </div>
                            <p class="text-sm text-text-light font-medium italic">Belum ada testimoni.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
