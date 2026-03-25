@extends('layouts.admin')

@section('header')
<div class="flex items-center justify-between">
    <div>
        <a href="{{ route('contacts.index') }}" class="inline-flex items-center gap-2 text-text-light hover:text-gold text-xs font-bold uppercase tracking-widest mb-3 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Inbox
        </a>
        <h2 class="text-3xl font-display font-black text-navy leading-tight">
            Detail <span class="text-gold">Pesan</span>
        </h2>
    </div>
</div>
@endsection

@section('content')
<div class="max-w-4xl bg-white rounded-2xl-custom border border-off-white shadow-custom overflow-hidden">
    <div class="p-8 border-b border-off-white bg-off-white/10 flex justify-between items-start">
        <div class="flex items-center gap-5">
            <div class="w-14 h-14 rounded-full bg-navy flex items-center justify-center text-white text-xl font-bold border-2 border-gold/30">
                {{ substr($contactMessage->name, 0, 1) }}
            </div>
            <div>
                <h3 class="text-lg font-bold text-navy">{{ $contactMessage->name }}</h3>
                <p class="text-sm text-text-light">{{ $contactMessage->email }}</p>
            </div>
        </div>
        <div class="text-right">
            <p class="text-[10px] text-text-light font-black uppercase tracking-widest">Diterima pada</p>
            <p class="text-xs font-bold text-navy">{{ $contactMessage->created_at->format('d M Y, H:i') }}</p>
        </div>
    </div>
    
    <div class="p-8">
        <div class="mb-8">
            <span class="text-[10px] font-black text-gold uppercase tracking-widest block mb-2">Subjek</span>
            <h4 class="text-xl font-display font-bold text-navy">{{ $contactMessage->subject ?? '(Tanpa Subjek)' }}</h4>
        </div>

        <div class="mb-12">
            <span class="text-[10px] font-black text-gold uppercase tracking-widest block mb-4">Isi Pesan</span>
            <div class="bg-off-white/20 p-6 rounded-xl border border-off-white text-text-mid leading-relaxed text-sm whitespace-pre-wrap">
                {{ $contactMessage->message }}
            </div>
        </div>

        <div class="flex justify-between items-center">
            <form action="{{ route('contacts.destroy', $contactMessage) }}" method="POST" onsubmit="return confirm('Hapus pesan ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="flex items-center gap-2 text-xs font-bold text-red-500 hover:text-red-700 transition-colors uppercase tracking-widest">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                    Hapus Pesan
                </button>
            </form>

            <a href="mailto:{{ $contactMessage->email }}" class="px-8 py-3 bg-gradient-to-r from-navy to-navy-light text-white font-bold text-xs rounded-xl hover:shadow-lg transition-all border border-gold/10 uppercase tracking-widest flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                Balas via Email
            </a>
        </div>
    </div>
</div>
@endsection
