@extends('admin.layouts.admin')

@section('title', 'Tambah Paket Baru')

@section('page_title', 'Paket Penerbitan')

@section('content')
<div class="content-header" style="margin-bottom: 25px;">
    <div style="display: flex; align-items: center; gap: 15px;">
        <a href="{{ route('admin.packages.index') }}" class="btn" style="background: var(--bg-card); color: var(--text-main); padding: 10px 15px;">
            <i class="fas fa-arrow-left"></i>
        </a>
        <h2 style="font-size: 1.5rem; font-weight: 700;">Tambah Paket Baru</h2>
    </div>
</div>

<div class="card" style="max-width: 800px; margin: 0 auto;">
    <form action="{{ route('admin.packages.store') }}" method="POST">
        @csrf
        
        <div class="grid-2" style="grid-template-columns: 2fr 1fr; margin-top: 20px;">
            <div class="form-group">
                <label>Nama Paket</label>
                <input type="text" name="name" value="{{ old('name') }}" required placeholder="E.g. Paket Hemat, Paket Pro..." class="@error('name') invalid @enderror">
                @error('name') <span class="error-text">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label>Harga (Rp)</label>
                <input type="number" name="price" value="{{ old('price') }}" required placeholder="0" class="@error('price') invalid @enderror">
                @error('price') <span class="error-text">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="form-group" style="margin-top: 20px;">
            <label>Deskripsi Singkat</label>
            <textarea name="description" rows="3" placeholder="Penjelasan singkat paket..." class="@error('description') invalid @enderror">{{ old('description') }}</textarea>
            @error('description') <span class="error-text">{{ $message }}</span> @enderror
        </div>

        <div class="form-group" style="margin-top: 25px;">
            <label style="display: flex; justify-content: space-between; align-items: center;">
                <span>Fitur Paket</span>
                <button type="button" class="btn btn-sm" id="addFeatureBtn" style="background: var(--bg-body); font-size: 0.8rem;">
                    <i class="fas fa-plus"></i> Tambah Fitur
                </button>
            </label>
            
            <div id="featuresList" class="grid-1" style="margin-top: 10px;">
                @if(old('features'))
                    @foreach(old('features') as $feature)
                        <div class="feature-item" style="display: flex; gap: 10px;">
                            <input type="text" name="features[]" value="{{ $feature }}" placeholder="E.g. ISBN Gratis, Editing Ringan..." required>
                            <button type="button" class="btn-remove" onclick="this.parentElement.remove()" style="background: none; border: none; color: #ef4444; cursor: pointer;">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    @endforeach
                @else
                    <div class="feature-item" style="display: flex; gap: 10px;">
                        <input type="text" name="features[]" placeholder="E.g. ISBN Gratis, Editing Ringan..." required>
                        <button type="button" class="btn-remove" onclick="this.parentElement.remove()" style="background: none; border: none; color: #ef4444; cursor: pointer;">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                @endif
            </div>
        </div>

        <div class="form-group" style="margin-top: 25px; display: flex; align-items: center; gap: 10px;">
            <input type="checkbox" name="is_featured" id="isFeatured" {{ old('is_featured') ? 'checked' : '' }} style="width: auto;">
            <label for="isFeatured" style="margin-bottom: 0; cursor: pointer;">Tandai sebagai Paket Unggulan (Featured)</label>
        </div>

        <div style="display: flex; gap: 15px; justify-content: flex-end; margin-top: 40px; padding-top: 20px; border-top: 1px solid var(--border-color);">
            <a href="{{ route('admin.packages.index') }}" class="btn" style="background: var(--border-color); color: var(--text-main);">Batal</a>
            <button type="submit" class="btn btn-primary" style="padding: 12px 30px;">Simpan Paket</button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    const addFeatureBtn = document.getElementById('addFeatureBtn');
    const featuresList = document.getElementById('featuresList');

    if (addFeatureBtn) {
        addFeatureBtn.addEventListener('click', () => {
            const div = document.createElement('div');
            div.className = 'feature-item';
            div.style.display = 'flex';
            div.style.gap = '10px';
            div.innerHTML = `
                <input type="text" name="features[]" placeholder="Isi fitur baru..." required>
                <button type="button" class="btn-remove" onclick="this.parentElement.remove()" style="background: none; border: none; color: #ef4444; cursor: pointer;">
                    <i class="fas fa-times"></i>
                </button>
            `;
            featuresList.appendChild(div);
            div.querySelector('input').focus();
        });
    }
</script>
@endsection
