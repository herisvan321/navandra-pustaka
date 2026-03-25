@extends('layouts.admin')

@section('header')
<div class="section-hero-content">
    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6">
        <div>
            <span class="section-tag">FAQ Management</span>
            <h2 class="section-title">Kelola <span class="gold italic">Pertanyaan</span></h2>
            <p class="section-desc" style="margin: 0; text-align: left; max-width: 600px;">
                Atur daftar pertanyaan yang sering diajukan untuk membantu penulis dan pelanggan memahami layanan Nevandra.
            </p>
        </div>
        <div class="flex items-center gap-4">
            <a href="{{ route('faqs.create') }}" class="btn-primary" style="text-decoration: none;">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                Tambah FAQ Baru
            </a>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="card" style="border-radius: 2.5rem; overflow: hidden;">
    <div class="p-8 border-b border-border flex items-center justify-between bg-white-custom">
        <h3 class="font-display font-black text-navy text-xl">Daftar FAQ</h3>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-white-custom">
                    <th class="px-8 py-5 text-[10px] uppercase tracking-[2px] text-text-light font-black">Urutan</th>
                    <th class="px-8 py-5 text-[10px] uppercase tracking-[2px] text-text-light font-black">Pertanyaan & Jawaban</th>
                    <th class="px-8 py-5 text-[10px] uppercase tracking-[2px] text-text-light font-black">Status</th>
                    <th class="px-8 py-5 text-[10px] uppercase tracking-[2px] text-text-light font-black text-right">Kelola</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-border">
                @forelse($faqs as $faq)
                <tr class="hover:bg-white-custom transition-all group">
                    <td class="px-8 py-6">
                        <span class="badge badge-navy">#{{ $faq->order }}</span>
                    </td>
                    <td class="px-8 py-6">
                        <div class="max-w-2xl">
                            <p class="text-sm font-black text-navy leading-tight mb-2 group-hover:text-gold transition-colors">{{ $faq->question }}</p>
                            <p class="text-xs text-text-mid line-clamp-2 leading-relaxed font-medium">{{ $faq->answer }}</p>
                        </div>
                    </td>
                    <td class="px-8 py-6">
                        @if($faq->is_active)
                        <span class="badge badge-green">Aktif</span>
                        @else
                        <span class="badge badge-navy" style="background: #f1f1f1; color: #999;">Non-aktif</span>
                        @endif
                    </td>
                    <td class="px-8 py-6 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('faqs.edit', $faq) }}" class="btn-outline" style="padding: 8px; border-radius: 12px; text-decoration: none;">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                            </a>
                            <form action="{{ route('faqs.destroy', $faq) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus FAQ ini?')">
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
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <p class="text-sm text-text-light font-medium italic">Belum ada pertanyaan yang dibuat.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
