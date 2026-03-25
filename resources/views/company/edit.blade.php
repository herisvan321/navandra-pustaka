@extends('layouts.admin')

@section('header')
<div class="flex items-center justify-between">
    <div>
        <span class="inline-block px-3 py-1 text-[10px] font-bold tracking-widest uppercase bg-gold/10 text-gold border border-gold/20 rounded-full mb-3">
            Identitas Bisnis
        </span>
        <h2 class="text-3xl font-display font-black text-navy leading-tight">
            Profil <span class="text-gold">Perusahaan</span>
        </h2>
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

<form action="{{ route('company-profile.update') }}" method="POST" class="max-w-5xl bg-white rounded-2xl-custom border border-off-white shadow-custom overflow-hidden">
    @csrf
    @method('PUT')
    
    <div class="grid grid-cols-1 lg:grid-cols-3">
        <!-- Sidebar Info -->
        <div class="p-8 bg-off-white/20 border-r border-off-white">
            <h3 class="text-sm font-black text-navy uppercase tracking-widest mb-6">Kontak & Lokasi</h3>
            
            <div class="space-y-6">
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-text-light mb-2">Nama Perusahaan</label>
                    <input type="text" name="name" value="{{ old('name', $profile->name) }}" class="w-full px-4 py-2.5 rounded-lg border border-off-white bg-white focus:outline-none focus:ring-2 focus:ring-gold/20 focus:border-gold transition-all text-sm" placeholder="Penerbit Nevandra">
                </div>

                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-text-light mb-2">Email Publik</label>
                    <input type="email" name="email" value="{{ old('email', $profile->email) }}" class="w-full px-4 py-2.5 rounded-lg border border-off-white bg-white focus:outline-none focus:ring-2 focus:ring-gold/20 focus:border-gold transition-all text-sm" placeholder="info@nevandra.com">
                </div>

                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-text-light mb-2">Nomor Telepon</label>
                    <input type="text" name="phone" value="{{ old('phone', $profile->phone) }}" class="w-full px-4 py-2.5 rounded-lg border border-off-white bg-white focus:outline-none focus:ring-2 focus:ring-gold/20 focus:border-gold transition-all text-sm" placeholder="+62 812...">
                </div>

                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-text-light mb-2">Alamat Kantor</label>
                    <textarea name="address" rows="3" class="w-full px-4 py-2.5 rounded-lg border border-off-white bg-white focus:outline-none focus:ring-2 focus:ring-gold/20 focus:border-gold transition-all text-sm" placeholder="Jl. Raya... ">{{ old('address', $profile->address) }}</textarea>
                </div>
            </div>
        </div>

        <!-- Main Info -->
        <div class="p-8 lg:col-span-2 space-y-8">
            <div>
                <h3 class="text-sm font-black text-navy uppercase tracking-widest mb-6">Visi & Misi</h3>
                
                <div class="space-y-6">
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-text-light mb-2">Visi Perusahaan</label>
                        <textarea name="vision" rows="3" class="w-full px-4 py-3 rounded-xl border border-off-white bg-off-white/30 focus:outline-none focus:ring-2 focus:ring-gold/20 focus:border-gold transition-all text-sm" placeholder="Menjadi penerbit... ">{{ old('vision', $profile->vision) }}</textarea>
                    </div>

                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-text-light mb-2">Misi (Poin-poin)</label>
                        <div id="mission-container" class="space-y-3">
                            @php $missions = old('mission', $profile->mission ?? ['']); @endphp
                            @foreach($missions as $m)
                            <div class="flex gap-2">
                                <input type="text" name="mission[]" value="{{ $m }}" class="flex-1 px-4 py-2 rounded-lg border border-off-white bg-off-white/30 focus:outline-none focus:ring-2 focus:ring-gold/20 focus:border-gold transition-all text-sm" placeholder="Misi baru...">
                                <button type="button" onclick="removeMission(this)" class="p-2 text-red-400 hover:text-red-600 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </div>
                            @endforeach
                        </div>
                        <button type="button" onclick="addMission()" class="mt-3 text-[10px] font-black text-gold uppercase tracking-widest hover:text-navy transition-colors">+ Tambah Misi</button>
                    </div>
                </div>
            </div>

            <div class="pt-8 border-t border-off-white">
                <h3 class="text-sm font-black text-navy uppercase tracking-widest mb-6">Sejarah Singkat</h3>
                <textarea name="history" rows="6" class="w-full px-4 py-3 rounded-xl border border-off-white bg-off-white/30 focus:outline-none focus:ring-2 focus:ring-gold/20 focus:border-gold transition-all text-sm" placeholder="Nevandra didirikan pada tahun... ">{{ old('history', $profile->history) }}</textarea>
            </div>

            <div class="pt-8 flex justify-end">
                <button type="submit" class="px-10 py-3 bg-gradient-to-r from-navy to-navy-light text-white font-bold text-xs rounded-xl hover:shadow-lg transition-all border border-gold/10 uppercase tracking-widest">Simpan Perubahan</button>
            </div>
        </div>
    </div>
</form>

<script>
    function addMission() {
        const container = document.getElementById('mission-container');
        const div = document.createElement('div');
        div.className = 'flex gap-2';
        div.innerHTML = `
            <input type="text" name="mission[]" class="flex-1 px-4 py-2 rounded-lg border border-off-white bg-off-white/30 focus:outline-none focus:ring-2 focus:ring-gold/20 focus:border-gold transition-all text-sm" placeholder="Misi baru...">
            <button type="button" onclick="removeMission(this)" class="p-2 text-red-400 hover:text-red-600 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
            </button>
        `;
        container.appendChild(div);
    }

    function removeMission(btn) {
        const container = document.getElementById('mission-container');
        if (container.children.length > 1) {
            btn.parentElement.remove();
        }
    }
</script>
@endsection
