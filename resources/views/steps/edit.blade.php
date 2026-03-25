@extends('layouts.admin')

@section('header')
<div class="flex items-center justify-between">
    <div>
        <a href="{{ route('publishing-steps.index') }}" class="inline-flex items-center gap-2 text-text-light hover:text-gold text-xs font-bold uppercase tracking-widest mb-3 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Daftar
        </a>
        <h2 class="text-3xl font-display font-black text-navy leading-tight">
            Edit <span class="text-gold">Langkah</span>
        </h2>
    </div>
</div>
@endsection

@section('content')
<div class="max-w-3xl">
    <form action="{{ route('publishing-steps.update', $step) }}" method="POST" class="bg-white rounded-2xl-custom border border-off-white shadow-custom p-8">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="md:col-span-2">
                <label class="block text-xs font-black uppercase tracking-widest text-navy mb-2">Judul Langkah</label>
                <input type="text" name="title" value="{{ old('title', $step->title) }}" class="w-full px-4 py-3 rounded-xl border border-off-white bg-off-white/30 focus:outline-none focus:ring-2 focus:ring-gold/20 focus:border-gold transition-all" placeholder="Contoh: Kirim Naskah">
                @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-xs font-black uppercase tracking-widest text-navy mb-2">Urutan</label>
                <input type="number" name="order" value="{{ old('order', $step->order) }}" class="w-full px-4 py-3 rounded-xl border border-off-white bg-off-white/30 focus:outline-none focus:ring-2 focus:ring-gold/20 focus:border-gold transition-all">
                @error('order') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-xs font-black uppercase tracking-widest text-navy mb-2">Icon (Opsional)</label>
                <input type="text" name="icon" value="{{ old('icon', $step->icon) }}" class="w-full px-4 py-3 rounded-xl border border-off-white bg-off-white/30 focus:outline-none focus:ring-2 focus:ring-gold/20 focus:border-gold transition-all" placeholder="Contoh: document-text">
            </div>

            <div class="md:col-span-2">
                <label class="block text-xs font-black uppercase tracking-widest text-navy mb-2">Deskripsi Detail</label>
                <textarea name="description" rows="5" class="w-full px-4 py-3 rounded-xl border border-off-white bg-off-white/30 focus:outline-none focus:ring-2 focus:ring-gold/20 focus:border-gold transition-all" placeholder="Jelaskan apa yang harus dilakukan penulis di tahap ini...">{{ old('description', $step->description) }}</textarea>
                @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="mt-8 flex justify-end gap-3">
            <a href="{{ route('publishing-steps.index') }}" class="px-6 py-3 bg-off-white text-text-mid font-bold text-xs rounded-xl hover:bg-off-white/80 transition-all uppercase tracking-widest">Batal</a>
            <button type="submit" class="px-8 py-3 bg-gradient-to-r from-navy to-navy-light text-white font-bold text-xs rounded-xl hover:shadow-lg transition-all border border-gold/10 uppercase tracking-widest">Perbarui Langkah</button>
        </div>
    </form>
</div>
@endsection
