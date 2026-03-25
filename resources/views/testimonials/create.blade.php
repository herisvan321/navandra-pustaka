@extends('layouts.admin')

@section('header')
<div class="flex items-center justify-between">
    <div>
        <a href="{{ route('testimonials.index') }}" class="inline-flex items-center gap-2 text-text-light hover:text-gold text-xs font-bold uppercase tracking-widest mb-3 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Daftar
        </a>
        <h2 class="text-3xl font-display font-black text-navy leading-tight">
            Tambah <span class="text-gold">Testimoni</span> Baru
        </h2>
    </div>
</div>
@endsection

@section('content')
<div class="max-w-3xl">
    <form action="{{ route('testimonials.store') }}" method="POST" class="bg-white rounded-2xl-custom border border-off-white shadow-custom p-8">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-xs font-black uppercase tracking-widest text-navy mb-2">Nama Pemberi Testimoni</label>
                <input type="text" name="name" value="{{ old('name') }}" class="w-full px-4 py-3 rounded-xl border border-off-white bg-off-white/30 focus:outline-none focus:ring-2 focus:ring-gold/20 focus:border-gold transition-all" placeholder="Nama Lengkap">
                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-xs font-black uppercase tracking-widest text-navy mb-2">Peran / Jabatan</label>
                <input type="text" name="role" value="{{ old('role') }}" class="w-full px-4 py-3 rounded-xl border border-off-white bg-off-white/30 focus:outline-none focus:ring-2 focus:ring-gold/20 focus:border-gold transition-all" placeholder="Contoh: Penulis, Mahasiswa">
            </div>

            <div>
                <label class="block text-xs font-black uppercase tracking-widest text-navy mb-2">Rating (1-5)</label>
                <select name="rating" class="w-full px-4 py-3 rounded-xl border border-off-white bg-off-white/30 focus:outline-none focus:ring-2 focus:ring-gold/20 focus:border-gold transition-all">
                    @for($i=5; $i>=1; $i--)
                    <option value="{{ $i }}" {{ old('rating') == $i ? 'selected' : '' }}>{{ $i }} Bintang</option>
                    @endfor
                </select>
            </div>

            <div>
                <label class="block text-xs font-black uppercase tracking-widest text-navy mb-2">Status</label>
                <select name="is_active" class="w-full px-4 py-3 rounded-xl border border-off-white bg-off-white/30 focus:outline-none focus:ring-2 focus:ring-gold/20 focus:border-gold transition-all">
                    <option value="1">Tampilkan</option>
                    <option value="0">Sembunyikan</option>
                </select>
            </div>

            <div class="md:col-span-2">
                <label class="block text-xs font-black uppercase tracking-widest text-navy mb-2">Avatar URL (Opsional)</label>
                <input type="text" name="avatar_path" value="{{ old('avatar_path') }}" class="w-full px-4 py-3 rounded-xl border border-off-white bg-off-white/30 focus:outline-none focus:ring-2 focus:ring-gold/20 focus:border-gold transition-all" placeholder="URL Foto">
            </div>

            <div class="md:col-span-2">
                <label class="block text-xs font-black uppercase tracking-widest text-navy mb-2">Isi Testimoni</label>
                <textarea name="content" rows="4" class="w-full px-4 py-3 rounded-xl border border-off-white bg-off-white/30 focus:outline-none focus:ring-2 focus:ring-gold/20 focus:border-gold transition-all" placeholder="Apa kesan mereka?">{{ old('content') }}</textarea>
                @error('content') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="mt-8 flex justify-end gap-3">
            <a href="{{ route('testimonials.index') }}" class="px-6 py-3 bg-off-white text-text-mid font-bold text-xs rounded-xl hover:bg-off-white/80 transition-all uppercase tracking-widest">Batal</a>
            <button type="submit" class="px-8 py-3 bg-gradient-to-r from-navy to-navy-light text-white font-bold text-xs rounded-xl hover:shadow-lg transition-all border border-gold/10 uppercase tracking-widest">Simpan Testimoni</button>
        </div>
    </form>
</div>
@endsection
