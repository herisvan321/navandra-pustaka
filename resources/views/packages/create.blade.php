@extends('layouts.admin')

@section('header')
<div class="flex items-center justify-between">
    <div>
        <a href="{{ route('packages.index') }}" class="inline-flex items-center gap-2 text-text-light hover:text-gold text-xs font-bold uppercase tracking-widest mb-3 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Daftar
        </a>
        <h2 class="text-3xl font-display font-black text-navy leading-tight">
            Tambah <span class="text-gold">Paket</span> Baru
        </h2>
    </div>
</div>
@endsection

@section('content')
<div class="max-w-4xl">
    <form action="{{ route('packages.store') }}" method="POST" class="bg-white rounded-2xl-custom border border-off-white shadow-custom p-8">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="space-y-6">
                <div>
                    <label class="block text-xs font-black uppercase tracking-widest text-navy mb-2">Nama Paket</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="w-full px-4 py-3 rounded-xl border border-off-white bg-off-white/30 focus:outline-none focus:ring-2 focus:ring-gold/20 focus:border-gold transition-all" placeholder="Contoh: Paket Digital">
                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-xs font-black uppercase tracking-widest text-navy mb-2">Tagline</label>
                    <input type="text" name="tagline" value="{{ old('tagline') }}" class="w-full px-4 py-3 rounded-xl border border-off-white bg-off-white/30 focus:outline-none focus:ring-2 focus:ring-gold/20 focus:border-gold transition-all" placeholder="Contoh: Ideal untuk penulis pemula">
                    @error('tagline') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-xs font-black uppercase tracking-widest text-navy mb-2">Harga (Rp)</label>
                    <input type="number" name="price" value="{{ old('price', 0) }}" class="w-full px-4 py-3 rounded-xl border border-off-white bg-off-white/30 focus:outline-none focus:ring-2 focus:ring-gold/20 focus:border-gold transition-all">
                    @error('price') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-black uppercase tracking-widest text-navy mb-2">Urutan</label>
                        <input type="number" name="order" value="{{ old('order', 0) }}" class="w-full px-4 py-3 rounded-xl border border-off-white bg-off-white/30 focus:outline-none focus:ring-2 focus:ring-gold/20 focus:border-gold transition-all">
                    </div>
                    <div>
                        <label class="block text-xs font-black uppercase tracking-widest text-navy mb-2">Tampilkan di Depan</label>
                        <select name="is_featured" class="w-full px-4 py-3 rounded-xl border border-off-white bg-off-white/30 focus:outline-none focus:ring-2 focus:ring-gold/20 focus:border-gold transition-all">
                            <option value="0" {{ old('is_featured') == '0' ? 'selected' : '' }}>Biasa</option>
                            <option value="1" {{ old('is_featured') == '1' ? 'selected' : '' }}>Terpopuler</option>
                        </select>
                    </div>
                </div>
            </div>

            <div>
                <label class="block text-xs font-black uppercase tracking-widest text-navy mb-2">Fitur Layanan</label>
                <div id="features-container" class="space-y-3">
                    <div class="flex gap-2">
                        <input type="text" name="features[]" class="flex-1 px-4 py-2 rounded-lg border border-off-white bg-off-white/30 focus:outline-none focus:ring-2 focus:ring-gold/20 focus:border-gold transition-all" placeholder="Fitur baru...">
                        <button type="button" onclick="removeFeature(this)" class="p-2 text-red-400 hover:text-red-600 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        </button>
                    </div>
                </div>
                <button type="button" onclick="addFeature()" class="mt-4 w-full py-2 border-2 border-dashed border-off-white rounded-xl text-text-light hover:text-gold hover:border-gold transition-all text-xs font-bold uppercase tracking-widest">
                    + Tambah Fitur
                </button>
                @error('features') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="mt-8 flex justify-end gap-3 border-t border-off-white pt-8">
            <a href="{{ route('packages.index') }}" class="px-6 py-3 bg-off-white text-text-mid font-bold text-xs rounded-xl hover:bg-off-white/80 transition-all uppercase tracking-widest">Batal</a>
            <button type="submit" class="px-8 py-3 bg-gradient-to-r from-navy to-navy-light text-white font-bold text-xs rounded-xl hover:shadow-lg transition-all border border-gold/10 uppercase tracking-widest">Simpan Paket</button>
        </div>
    </form>
</div>

<script>
    function addFeature() {
        const container = document.getElementById('features-container');
        const div = document.createElement('div');
        div.className = 'flex gap-2';
        div.innerHTML = `
            <input type="text" name="features[]" class="flex-1 px-4 py-2 rounded-lg border border-off-white bg-off-white/30 focus:outline-none focus:ring-2 focus:ring-gold/20 focus:border-gold transition-all" placeholder="Fitur baru...">
            <button type="button" onclick="removeFeature(this)" class="p-2 text-red-400 hover:text-red-600 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
            </button>
        `;
        container.appendChild(div);
    }

    function removeFeature(btn) {
        const container = document.getElementById('features-container');
        if (container.children.length > 1) {
            btn.parentElement.remove();
        }
    }
</script>
@endsection
