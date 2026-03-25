@extends('layouts.admin')

@section('header')
<div class="flex items-center justify-between">
    <div>
        <span class="inline-block px-3 py-1 text-[10px] font-bold tracking-widest uppercase bg-gold/10 text-gold border border-gold/20 rounded-full mb-3">
            Panduan Penulis
        </span>
        <h2 class="text-3xl font-display font-black text-navy leading-tight">
            Alur <span class="text-gold">Penerbitan</span>
        </h2>
    </div>
    <div>
        <a href="{{ route('publishing-steps.create') }}" class="px-5 py-2.5 bg-gradient-to-r from-navy to-navy-light text-white font-bold text-xs rounded-xl hover:shadow-lg transition-all border border-gold/10 flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Tambah Langkah
        </a>
    </div>
</div>
@endsection

@section('content')
<div class="max-w-4xl space-y-4">
    @forelse($steps as $step)
    <div class="bg-white rounded-2xl-custom border border-off-white shadow-custom p-6 flex items-center gap-6 group hover:border-gold/30 transition-all">
        <div class="w-14 h-14 bg-navy rounded-xl flex items-center justify-center text-gold text-xl font-display font-black border border-gold/20 flex-shrink-0">
            {{ $step->order }}
        </div>
        <div class="flex-1">
            <h4 class="text-lg font-bold text-navy">{{ $step->title }}</h4>
            <p class="text-sm text-text-mid mt-1">{{ Str::limit($step->description, 120) }}</p>
        </div>
        <div class="flex gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
            <a href="{{ route('publishing-steps.edit', $step) }}" class="p-2 text-text-light hover:text-navy transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
            </a>
            <form action="{{ route('publishing-steps.destroy', $step) }}" method="POST" onsubmit="return confirm('Hapus langkah ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="p-2 text-text-light hover:text-red-600 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                </button>
            </form>
        </div>
    </div>
    @empty
    <div class="py-20 text-center bg-white rounded-2xl-custom border border-dashed border-off-white">
        <p class="text-text-light text-sm italic">Belum ada langkah penerbitan yang diatur.</p>
    </div>
    @endforelse
</div>
@endsection
