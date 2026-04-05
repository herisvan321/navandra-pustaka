@extends('admin.layouts.admin')

@section('title', 'Tambah Event Baru')

@section('page_title', 'Event Menulis')

@section('content')
<div class="content-header" style="margin-bottom: 25px;">
    <div style="display: flex; align-items: center; gap: 15px;">
        <a href="{{ route('admin.events.index') }}" class="btn" style="background: var(--bg-card); color: var(--text-main); padding: 10px 15px;">
            <i class="fas fa-arrow-left"></i>
        </a>
        <h2 style="font-size: 1.5rem; font-weight: 700;">Tambah Event Baru</h2>
    </div>
</div>

<div class="card" style="max-width: 800px; margin: 0 auto;">
    <form action="{{ route('admin.events.store') }}" method="POST">
        @csrf
        
        <div class="form-group">
            <label>Judul Event</label>
            <input type="text" name="title" value="{{ old('title') }}" required placeholder="E.g. Lomba Menulis Cerpen Nasional..." class="@error('title') invalid @enderror">
            @error('title') <span class="error-text">{{ $message }}</span> @enderror
        </div>

        <div class="grid-2" style="margin-top: 20px;">
            <div class="form-group">
                <label>Tipe Event</label>
                <select name="type" class="@error('type') invalid @enderror">
                    <option value="competition" {{ old('type') == 'competition' ? 'selected' : '' }}>Kompetisi (Lomba)</option>
                    <option value="webinar" {{ old('type') == 'webinar' ? 'selected' : '' }}>Webinar / Workshop</option>
                    <option value="other" {{ old('type') == 'other' ? 'selected' : '' }}>Lainnya</option>
                </select>
                @error('type') <span class="error-text">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label>Deadline (Batas Akhir)</label>
                <input type="date" name="deadline" value="{{ old('deadline') }}" required class="@error('deadline') invalid @enderror">
                @error('deadline') <span class="error-text">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="form-group" style="margin-top: 20px;">
            <label>Deskripsi Event</label>
            <textarea name="description" rows="5" placeholder="Tuliskan detail event, syarat, dan prasyarat..." class="@error('description') invalid @enderror">{{ old('description') }}</textarea>
            @error('description') <span class="error-text">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label>Link Pendaftaran / Informasi</label>
            <input type="url" name="link" value="{{ old('link') }}" placeholder="https://..." class="@error('link') invalid @enderror">
            @error('link') <span class="error-text">{{ $message }}</span> @enderror
        </div>

        <div class="form-group" style="margin-top: 25px; display: flex; align-items: center; gap: 10px;">
            <input type="checkbox" name="is_active" id="isActive" {{ old('is_active', true) ? 'checked' : '' }} style="width: auto;">
            <label for="isActive" style="margin-bottom: 0; cursor: pointer;">Event Aktif (Tampilkan di Website)</label>
        </div>

        <div style="display: flex; gap: 15px; justify-content: flex-end; margin-top: 40px; padding-top: 20px; border-top: 1px solid var(--border-color);">
            <a href="{{ route('admin.events.index') }}" class="btn" style="background: var(--border-color); color: var(--text-main);">Batal</a>
            <button type="submit" class="btn btn-primary" style="padding: 12px 30px;">Simpan Event</button>
        </div>
    </form>
</div>
@endsection
