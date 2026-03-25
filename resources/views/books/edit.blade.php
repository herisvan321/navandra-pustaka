@extends('layouts.admin')

@section('header')
<div class="flex items-center justify-between">
    <div>
        <a href="{{ route('books.index') }}" class="inline-flex items-center gap-2 text-text-light hover:text-gold text-xs font-bold uppercase tracking-widest mb-3 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Daftar
        </a>
        <h2 class="text-3xl font-display font-black text-navy leading-tight">
            Edit <span class="text-gold">Koleksi</span> Buku
        </h2>
    </div>
</div>
@endsection

@section('content')
<div class="max-w-3xl">
    <form action="{{ route('books.update', $book) }}" method="POST" class="bg-white rounded-2xl-custom border border-off-white shadow-custom p-8">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="md:col-span-2">
                <label class="block text-xs font-black uppercase tracking-widest text-navy mb-2">Judul Buku</label>
                <input type="text" name="title" value="{{ old('title', $book->title) }}" class="w-full px-4 py-3 rounded-xl border border-off-white bg-off-white/30 focus:outline-none focus:ring-2 focus:ring-gold/20 focus:border-gold transition-all" placeholder="Masukkan judul buku...">
                @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-xs font-black uppercase tracking-widest text-navy mb-2">Penulis</label>
                <input type="text" name="author" value="{{ old('author', $book->author) }}" class="w-full px-4 py-3 rounded-xl border border-off-white bg-off-white/30 focus:outline-none focus:ring-2 focus:ring-gold/20 focus:border-gold transition-all" placeholder="Nama penulis...">
                @error('author') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-xs font-black uppercase tracking-widest text-navy mb-2">Kategori</label>
                <select name="category" class="w-full px-4 py-3 rounded-xl border border-off-white bg-off-white/30 focus:outline-none focus:ring-2 focus:ring-gold/20 focus:border-gold transition-all">
                    <option value="">Pilih Kategori</option>
                    <option value="Sastra" {{ (old('category', $book->category) == 'Sastra') ? 'selected' : '' }}>Sastra</option>
                    <option value="Sejarah" {{ (old('category', $book->category) == 'Sejarah') ? 'selected' : '' }}>Sejarah</option>
                    <option value="Budaya" {{ (old('category', $book->category) == 'Budaya') ? 'selected' : '' }}>Budaya</option>
                    <option value="Pendidikan" {{ (old('category', $book->category) == 'Pendidikan') ? 'selected' : '' }}>Pendidikan</option>
                </select>
                @error('category') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-xs font-black uppercase tracking-widest text-navy mb-2">ISBN</label>
                <input type="text" name="isbn" value="{{ old('isbn', $book->isbn) }}" class="w-full px-4 py-3 rounded-xl border border-off-white bg-off-white/30 focus:outline-none focus:ring-2 focus:ring-gold/20 focus:border-gold transition-all" placeholder="Contoh: 978-602-...">
                @error('isbn') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-xs font-black uppercase tracking-widest text-navy mb-2">Harga (Rp)</label>
                <input type="number" name="price" value="{{ old('price', $book->price) }}" class="w-full px-4 py-3 rounded-xl border border-off-white bg-off-white/30 focus:outline-none focus:ring-2 focus:ring-gold/20 focus:border-gold transition-all">
                @error('price') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="md:col-span-2">
                <label class="block text-xs font-black uppercase tracking-widest text-navy mb-2">Deskripsi / Sinopsis</label>
                <textarea name="description" rows="5" class="w-full px-4 py-3 rounded-xl border border-off-white bg-off-white/30 focus:outline-none focus:ring-2 focus:ring-gold/20 focus:border-gold transition-all" placeholder="Tuliskan ringkasan buku...">{{ old('description', $book->description) }}</textarea>
                @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="mt-8 flex justify-end gap-3">
            <a href="{{ route('books.index') }}" class="px-6 py-3 bg-off-white text-text-mid font-bold text-xs rounded-xl hover:bg-off-white/80 transition-all uppercase tracking-widest">Batal</a>
            <button type="submit" class="px-8 py-3 bg-gradient-to-r from-navy to-navy-light text-white font-bold text-xs rounded-xl hover:shadow-lg transition-all border border-gold/10 uppercase tracking-widest">Perbarui Koleksi</button>
        </div>
    </form>
</div>
@endsection
