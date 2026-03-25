@extends('layouts.admin')

@section('header')
<div class="flex items-center justify-between">
    <div>
        <a href="{{ route('events.index') }}" class="inline-flex items-center gap-2 text-text-light hover:text-gold text-xs font-bold uppercase tracking-widest mb-3 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Daftar
        </a>
        <h2 class="text-3xl font-display font-black text-navy leading-tight">
            Edit <span class="text-gold">Event</span>
        </h2>
    </div>
</div>
@endsection

@section('content')
<div class="max-w-3xl">
    <form action="{{ route('events.update', $event) }}" method="POST" class="bg-white rounded-2xl-custom border border-off-white shadow-custom p-8">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="md:col-span-2">
                <label class="block text-xs font-black uppercase tracking-widest text-navy mb-2">Judul Event</label>
                <input type="text" name="title" value="{{ old('title', $event->title) }}" class="w-full px-4 py-3 rounded-xl border border-off-white bg-off-white/30 focus:outline-none focus:ring-2 focus:ring-gold/20 focus:border-gold transition-all" placeholder="Contoh: Lomba Menulis Cerpen Nasional">
                @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-xs font-black uppercase tracking-widest text-navy mb-2">Tipe Event</label>
                <select name="type" class="w-full px-4 py-3 rounded-xl border border-off-white bg-off-white/30 focus:outline-none focus:ring-2 focus:ring-gold/20 focus:border-gold transition-all">
                    <option value="Lomba" {{ old('type', $event->type) == 'Lomba' ? 'selected' : '' }}>Lomba</option>
                    <option value="Antologi" {{ old('type', $event->type) == 'Antologi' ? 'selected' : '' }}>Antologi</option>
                    <option value="Workshop" {{ old('type', $event->type) == 'Workshop' ? 'selected' : '' }}>Workshop</option>
                    <option value="Seminar" {{ old('type', $event->type) == 'Seminar' ? 'selected' : '' }}>Seminar</option>
                </select>
                @error('type') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-xs font-black uppercase tracking-widest text-navy mb-2">Genre (Opsional)</label>
                <input type="text" name="genre" value="{{ old('genre', $event->genre) }}" class="w-full px-4 py-3 rounded-xl border border-off-white bg-off-white/30 focus:outline-none focus:ring-2 focus:ring-gold/20 focus:border-gold transition-all" placeholder="Contoh: Fiksi, Sejarah">
            </div>

            <div>
                <label class="block text-xs font-black uppercase tracking-widest text-navy mb-2">Deadline</label>
                <input type="date" name="deadline" value="{{ old('deadline', $event->deadline ? $event->deadline->format('Y-m-d') : '') }}" class="w-full px-4 py-3 rounded-xl border border-off-white bg-off-white/30 focus:outline-none focus:ring-2 focus:ring-gold/20 focus:border-gold transition-all">
                @error('deadline') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-xs font-black uppercase tracking-widest text-navy mb-2">Status</label>
                <select name="is_active" class="w-full px-4 py-3 rounded-xl border border-off-white bg-off-white/30 focus:outline-none focus:ring-2 focus:ring-gold/20 focus:border-gold transition-all">
                    <option value="1" {{ old('is_active', $event->is_active) ? 'selected' : '' }}>Aktif / Berlangsung</option>
                    <option value="0" {{ !old('is_active', $event->is_active) ? 'selected' : '' }}>Selesai / Non-Aktif</option>
                </select>
            </div>

            <div class="md:col-span-2">
                <label class="block text-xs font-black uppercase tracking-widest text-navy mb-2">Deskripsi Event</label>
                <textarea name="description" rows="5" class="w-full px-4 py-3 rounded-xl border border-off-white bg-off-white/30 focus:outline-none focus:ring-2 focus:ring-gold/20 focus:border-gold transition-all" placeholder="Tuliskan detail event...">{{ old('description', $event->description) }}</textarea>
                @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="mt-8 flex justify-end gap-3">
            <a href="{{ route('events.index') }}" class="px-6 py-3 bg-off-white text-text-mid font-bold text-xs rounded-xl hover:bg-off-white/80 transition-all uppercase tracking-widest">Batal</a>
            <button type="submit" class="px-8 py-3 bg-gradient-to-r from-navy to-navy-light text-white font-bold text-xs rounded-xl hover:shadow-lg transition-all border border-gold/10 uppercase tracking-widest">Perbarui Event</button>
        </div>
    </form>
</div>
@endsection
