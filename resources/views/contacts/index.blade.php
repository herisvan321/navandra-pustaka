@extends('layouts.admin')

@section('header')
<div class="section-hero-content">
    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6">
        <div>
            <span class="section-tag">Inbox Management</span>
            <h2 class="section-title">Pesan <span class="gold italic">Masuk</span></h2>
            <p class="section-desc" style="margin: 0; text-align: left; max-width: 600px;">
                Kelola komunikasi dengan penulis dan pelanggan melalui formulir kontak.
            </p>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="card" style="border-radius: 2.5rem; overflow: hidden;">
    <div class="p-8 border-b border-border flex items-center justify-between bg-white-custom">
        <h3 class="font-display font-black text-navy text-xl">Daftar Pesan</h3>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-white-custom">
                    <th class="px-8 py-5 text-[10px] uppercase tracking-[2px] text-text-light font-black">Pengirim</th>
                    <th class="px-8 py-5 text-[10px] uppercase tracking-[2px] text-text-light font-black">Subjek & Isi Pesan</th>
                    <th class="px-8 py-5 text-[10px] uppercase tracking-[2px] text-text-light font-black">Waktu</th>
                    <th class="px-8 py-5 text-[10px] uppercase tracking-[2px] text-text-light font-black text-right">Kelola</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-border">
                @forelse($messages as $msg)
                <tr class="hover:bg-white-custom transition-all group {{ !$msg->is_read ? 'bg-gold/5 font-bold' : '' }}">
                    <td class="px-8 py-6">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-full {{ !$msg->is_read ? 'bg-navy text-gold' : 'bg-navy/10 text-navy' }} flex items-center justify-center text-xs font-bold shadow-sm">
                                {{ substr($msg->name, 0, 1) }}
                            </div>
                            <div>
                                <p class="text-sm font-black text-navy leading-tight mb-1 group-hover:text-gold transition-colors">{{ $msg->name }}</p>
                                <p class="text-[10px] font-bold text-text-light/60 uppercase tracking-wider">{{ $msg->email }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-8 py-6">
                        <div class="max-w-md">
                            <p class="text-sm font-black text-navy leading-tight mb-1">{{ $msg->subject ?? 'Tanpa Subjek' }}</p>
                            <p class="text-xs text-text-mid line-clamp-1 font-medium">{{ $msg->message }}</p>
                        </div>
                    </td>
                    <td class="px-8 py-6">
                        <span class="text-[10px] font-bold text-text-light uppercase tracking-widest">{{ $msg->created_at->format('d M Y, H:i') }}</span>
                    </td>
                    <td class="px-8 py-6 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('contacts.show', $msg) }}" class="btn-outline" style="padding: 8px; border-radius: 12px; text-decoration: none;">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            </a>
                            <form action="{{ route('contacts.destroy', $msg) }}" method="POST" onsubmit="return confirm('Hapus pesan ini?')">
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
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                            <p class="text-sm text-text-light font-medium italic">Belum ada pesan masuk.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
