@extends('layouts.admin')

@section('header')
<div class="section-hero-content">
    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6">
        <div>
            <span class="section-tag">Publishing Packages</span>
            <h2 class="section-title">Kelola <span class="gold italic">Paket Terbit</span></h2>
            <p class="section-desc" style="margin: 0; text-align: left; max-width: 600px;">
                Atur pilihan paket harga dan fasilitas yang ditawarkan kepada penulis.
            </p>
        </div>
        <div class="flex items-center gap-4">
            <a href="{{ route('packages.create') }}" class="btn-primary" style="text-decoration: none;">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                Tambah Paket Baru
            </a>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="card" style="border-radius: 2.5rem; overflow: hidden;">
    <div class="p-8 border-b border-border flex items-center justify-between bg-white-custom">
        <h3 class="font-display font-black text-navy text-xl">Daftar Paket</h3>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-white-custom">
                    <th class="px-8 py-5 text-[10px] uppercase tracking-[2px] text-text-light font-black">Nama Paket</th>
                    <th class="px-8 py-5 text-[10px] uppercase tracking-[2px] text-text-light font-black">Harga</th>
                    <th class="px-8 py-5 text-[10px] uppercase tracking-[2px] text-text-light font-black">Fitur Utama</th>
                    <th class="px-8 py-5 text-[10px] uppercase tracking-[2px] text-text-light font-black text-right">Kelola</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-border">
                @forelse($packages as $package)
                <tr class="hover:bg-white-custom transition-all group">
                    <td class="px-8 py-6">
                        <div class="flex items-center gap-4">
                            @if($package->is_featured)
                            <div class="w-2 h-10 bg-gold rounded-full"></div>
                            @else
                            <div class="w-2 h-10 bg-navy/10 rounded-full"></div>
                            @endif
                            <div>
                                <p class="text-sm font-black text-navy leading-tight mb-1 group-hover:text-gold transition-colors">{{ $package->name }}</p>
                                <p class="text-[10px] font-bold text-text-light/60 uppercase tracking-wider">{{ $package->tagline ?? 'Paket Penerbitan' }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-8 py-6">
                        <span class="text-sm font-bold text-navy">Rp {{ number_format($package->price, 0, ',', '.') }}</span>
                    </td>
                    <td class="px-8 py-6">
                        <div class="flex flex-wrap gap-2">
                            @if(is_array($package->features))
                                @foreach(array_slice($package->features, 0, 3) as $feature)
                                <span class="badge badge-navy" style="font-size: 9px;">{{ $feature }}</span>
                                @endforeach
                                @if(count($package->features) > 3)
                                <span class="badge badge-gold" style="font-size: 9px;">+{{ count($package->features) - 3 }} Lainnya</span>
                                @endif
                            @endif
                        </div>
                    </td>
                    <td class="px-8 py-6 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('packages.edit', $package) }}" class="btn-outline" style="padding: 8px; border-radius: 12px; text-decoration: none;">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                            </a>
                            <form action="{{ route('packages.destroy', $package) }}" method="POST" onsubmit="return confirm('Hapus paket ini?')">
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
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 v2M7 7h10"></path></svg>
                            </div>
                            <p class="text-sm text-text-light font-medium italic">Belum ada paket penerbitan.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
