@extends('admin.layouts.admin')

@section('title', 'Tambah Foto Galeri')

@section('page_title', 'Galeri Foto')

@section('content')
<div class="content-header" style="margin-bottom: 25px;">
    <div style="display: flex; align-items: center; gap: 15px;">
        <a href="{{ route('admin.gallery.index') }}" class="btn" style="background: var(--bg-card); color: var(--text-main); padding: 10px 15px;">
            <i class="fas fa-arrow-left"></i>
        </a>
        <h2 style="font-size: 1.5rem; font-weight: 700;">Tambah Foto Baru</h2>
    </div>
</div>

<div class="card" style="max-width: 800px; margin: 0 auto;">
    <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="form-group">
            <label>Judul Foto / Kegiatan</label>
            <input type="text" name="title" value="{{ old('title') }}" required placeholder="E.g. Peluncuran Buku A, Workshop Penulisan..." class="@error('title') invalid @enderror">
            @error('title') <span class="error-text">{{ $message }}</span> @enderror
        </div>

        <div class="grid-2" style="margin-top: 20px;">
            <div class="form-group">
                <label>Kategori / Tipe</label>
                <select name="type" class="@error('type') invalid @enderror">
                    <option value="gallery" {{ old('type') == 'gallery' ? 'selected' : '' }}>Galeri Umum</option>
                    <option value="event" {{ old('type') == 'event' ? 'selected' : '' }}>Event / Kegiatan</option>
                    <option value="office" {{ old('type') == 'office' ? 'selected' : '' }}>Internal Kantor</option>
                </select>
                @error('type') <span class="error-text">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label>Tanggal Kegiatan (Opsional)</label>
                <input type="date" name="event_date" value="{{ old('event_date') }}" class="@error('event_date') invalid @enderror">
                @error('event_date') <span class="error-text">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="form-group" style="margin-top: 20px;">
            <label>Keterangan Foto</label>
            <textarea name="description" rows="3" placeholder="Ceritakan sedikit tentang foto ini..." class="@error('description') invalid @enderror">{{ old('description') }}</textarea>
            @error('description') <span class="error-text">{{ $message }}</span> @enderror
        </div>

        <div class="form-group" style="margin-top: 20px;">
            <label>Pilih Foto</label>
            <div class="image-preview-wrapper" onclick="document.getElementById('imageInput').click()" style="cursor: pointer; max-width: 100%; height: 350px;">
                <div class="preview-placeholder" id="placeholder">
                    <i class="fas fa-cloud-upload-alt"></i>
                    <span>Klik untuk pilih foto</span>
                </div>
                <img id="imagePreview" class="preview-img" style="display: none;">
            </div>
            <input type="file" name="image" id="imageInput" accept="image/*" required class="@error('image') invalid @enderror" style="display: none;">
            @error('image') <span class="error-text">{{ $message }}</span> @enderror
        </div>

        <div style="display: flex; gap: 15px; justify-content: flex-end; margin-top: 40px; padding-top: 20px; border-top: 1px solid var(--border-color);">
            <a href="{{ route('admin.gallery.index') }}" class="btn" style="background: var(--border-color); color: var(--text-main);">Batal</a>
            <button type="submit" class="btn btn-primary" style="padding: 12px 30px;">Unggah Foto</button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    const imageInput = document.getElementById('imageInput');
    const imagePreview = document.getElementById('imagePreview');
    const placeholder = document.getElementById('placeholder');

    if (imageInput) {
        imageInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    imagePreview.style.display = 'block';
                    if (placeholder) placeholder.style.display = 'none';
                }
                reader.readAsDataURL(file);
            }
        });
    }
</script>
@endsection
