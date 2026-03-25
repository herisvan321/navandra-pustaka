@extends('layouts.admin')

@section('header')
<div class="flex items-center justify-between">
    <div>
        <a href="{{ route('news.index') }}" class="inline-flex items-center gap-2 text-text-light hover:text-gold text-xs font-bold uppercase tracking-widest mb-3 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Daftar
        </a>
        <h2 class="text-3xl font-display font-black text-navy leading-tight">
            Edit <span class="text-gold">Berita</span>
        </h2>
    </div>
</div>
@endsection

@section('content')
<div class="max-w-4xl">
    <form action="{{ route('news.update', $news) }}" method="POST" class="bg-white rounded-2xl-custom border border-off-white shadow-custom p-8">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 gap-6">
            <div>
                <label class="block text-xs font-black uppercase tracking-widest text-navy mb-2">Judul Berita</label>
                <input type="text" name="title" value="{{ old('title', $news->title) }}" class="w-full px-4 py-3 rounded-xl border border-off-white bg-off-white/30 focus:outline-none focus:ring-2 focus:ring-gold/20 focus:border-gold transition-all" placeholder="Masukkan judul berita yang menarik...">
                @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-black uppercase tracking-widest text-navy mb-2">URL Gambar Sampul</label>
                    <input type="text" name="image_path" value="{{ old('image_path', $news->image_path) }}" class="w-full px-4 py-3 rounded-xl border border-off-white bg-off-white/30 focus:outline-none focus:ring-2 focus:ring-gold/20 focus:border-gold transition-all" placeholder="https://source.unsplash.com/...">
                </div>
                <div>
                    <label class="block text-xs font-black uppercase tracking-widest text-navy mb-2">Opsi Publikasi</label>
                    <div class="flex items-center gap-4 mt-3">
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="is_published" value="1" {{ old('is_published', $news->is_published) ? 'checked' : '' }} class="rounded border-off-white text-gold focus:ring-gold/20">
                            <span class="ml-2 text-sm text-text-mid">Terbit</span>
                        </label>
                    </div>
                </div>
            </div>

            <div>
                <label class="block text-xs font-black uppercase tracking-widest text-navy mb-2">Konten Berita</label>
                <textarea name="content" rows="15" class="w-full px-4 py-3 rounded-xl border border-off-white bg-off-white/30 focus:outline-none focus:ring-2 focus:ring-gold/20 focus:border-gold transition-all text-sm" placeholder="Tulis isi berita di sini...">{{ old('content', $news->content) }}</textarea>
                @error('content') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="mt-8 flex justify-end gap-3 border-t border-off-white pt-8">
            <a href="{{ route('news.index') }}" class="px-6 py-3 bg-off-white text-text-mid font-bold text-xs rounded-xl hover:bg-off-white/80 transition-all uppercase tracking-widest">Batal</a>
            <button type="submit" class="px-8 py-3 bg-gradient-to-r from-navy to-navy-light text-white font-bold text-xs rounded-xl hover:shadow-lg transition-all border border-gold/10 uppercase tracking-widest">Perbarui Berita</button>
        </div>
    </form>
</div>
@endsection
