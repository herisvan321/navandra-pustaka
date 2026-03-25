@extends('layouts.admin')

@section('header')
<div class="flex items-center justify-between">
    <div>
        <span class="inline-block px-3 py-1 text-[10px] font-bold tracking-widest uppercase bg-gold/10 text-gold border border-gold/20 rounded-full mb-3">
            Informasi & Media
        </span>
        <h2 class="text-3xl font-display font-black text-navy leading-tight">
            Berita <span class="text-gold">Terkini</span>
        </h2>
    </div>
    <div>
        <a href="{{ route('news.create') }}" class="px-5 py-2.5 bg-gradient-to-r from-navy to-navy-light text-white font-bold text-xs rounded-xl hover:shadow-lg transition-all border border-gold/10 flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Tulis Berita Baru
        </a>
    </div>
</div>
@endsection

@section('content')
@if(session('success'))
<div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 text-sm rounded-xl flex items-center gap-3">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
    {{ session('success') }}
</div>
@endif

<div class="bg-white rounded-2xl-custom border border-off-white shadow-custom overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-off-white/30 text-[10px] uppercase tracking-widest text-text-light font-black">
                <tr>
                    <th class="px-6 py-4">Berita</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4">Tanggal Rilis</th>
                    <th class="px-6 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-off-white">
                @forelse($news as $item)
                <tr class="hover:bg-off-white/10 transition-colors">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-4">
                            <div class="w-16 h-12 bg-navy-mid rounded-lg overflow-hidden border border-gold/10 flex-shrink-0">
                                @if($item->image_path)
                                <img src="{{ $item->image_path }}" alt="{{ $item->title }}" class="w-full h-full object-cover">
                                @else
                                <div class="w-full h-full flex items-center justify-center text-gold/20">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                                @endif
                            </div>
                            <div>
                                <p class="text-sm font-bold text-navy leading-tight">{{ $item->title }}</p>
                                <p class="text-[10px] text-text-light mt-1">{{ Str::limit(strip_tags($item->content), 60) }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        @if($item->is_published)
                        <span class="px-2.5 py-1 bg-green-100 text-green-700 text-[10px] font-bold rounded-md uppercase tracking-wider border border-green-200">Terbit</span>
                        @else
                        <span class="px-2.5 py-1 bg-off-white text-text-light text-[10px] font-bold rounded-md uppercase tracking-wider border border-off-white">Draft</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-xs text-text-mid font-medium">
                        {{ $item->published_at ? $item->published_at->format('d M Y, H:i') : '-' }}
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex justify-end gap-2">
                            <a href="{{ route('news.edit', $item) }}" class="p-2 text-text-light hover:text-navy transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                            </a>
                            <form action="{{ route('news.destroy', $item) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-text-light hover:text-red-600 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-12 text-center text-text-light text-sm italic">
                        Belum ada berita yang tersedia.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($news->hasPages())
    <div class="px-6 py-4 bg-off-white/10 border-t border-off-white">
        {{ $news->links() }}
    </div>
    @endif
</div>
@endsection
