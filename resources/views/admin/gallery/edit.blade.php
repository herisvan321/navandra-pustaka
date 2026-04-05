@extends('admin.layouts.admin')

@section('title', 'Edit Foto: ' . $item->title)

@section('page_title', 'Galeri Foto')

@section('content')
<div class="content-header" style="margin-bottom: 25px;">
    <div style="display: flex; align-items: center; gap: 15px;">
        <a href="{{ route('admin.gallery.index') }}" class="btn" style="background: var(--bg-card); color: var(--text-main); padding: 10px 15px;">
            <i class="fas fa-arrow-left"></i>
        </a>
        <h2 style="font-size: 1.5rem; font-weight: 700;">Edit Item Galeri</h2>
    </div>
</div>

<div class="card" style="max-width: 800px; margin: 0 auto;">
    <form action="{{ route('admin.gallery.update', $item->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label>Judul Foto / Kegiatan</label>
            <input type="text" name="title" value="{{ old('title', $item->title) }}" required placeholder="E.g. Peluncuran Buku A, Workshop Penulisan..." class="@error('title') invalid @enderror">
            @error('title') <span class="error-text">{{ $message }}</span> @enderror
        </div>

        <div class="grid-2" style="margin-top: 20px;">
            <div class="form-group">
                <label>Kategori / Tipe</label>
                <select name="type" class="@error('type') invalid @enderror">
                    <option value="gallery" {{ old('type', $item->type) == 'gallery' ? 'selected' : '' }}>Galeri Umum</option>
                    <option value="event" {{ old('type', $item->type) == 'event' ? 'selected' : '' }}>Event / Kegiatan</option>
                    <option value="office" {{ old('type', $item->type) == 'office' ? 'selected' : '' }}>Internal Kantor</option>
                </select>
                @error('type') <span class="error-text">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label>Tanggal Kegiatan (Opsional)</label>
                <input type="date" name="event_date" value="{{ old('event_date', $item->event_date) }}" class="@error('event_date') invalid @enderror">
                @error('event_date') <span class="error-text">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="form-group" style="margin-top: 20px;">
            <label>Keterangan Foto</label>
            <textarea name="description" rows="3" placeholder="Ceritakan sedikit tentang foto ini..." class="@error('description') invalid @enderror">{{ old('description', $item->description) }}</textarea>
            @error('description') <span class="error-text">{{ $message }}</span> @enderror
        </div>

        <div class="form-group" style="margin-top: 20px;">
            <label>Ganti Foto (Kosongkan jika tidak ingin diganti)</label>
            <div class="image-preview-wrapper" onclick="document.getElementById('imageInput').click()" style="cursor: pointer; max-width: 100%; height: 350px;">
                <div class="preview-placeholder" id="placeholder" style="{{ $item->image_path ? 'display: none;' : '' }}">
                    <i class="fas fa-cloud-upload-alt"></i>
                    <span>Klik untuk pilih foto</span>
                </div>
                <img id="imagePreview" src="{{ $item->image_path ? asset('storage/' . $item->image_path) : '' }}" class="preview-img" style="{{ $item->image_path ? '' : 'display: none;' }}">
            </div>
            <input type="file" name="image" id="imageInput" accept="image/*" class="@error('image') invalid @enderror" style="display: none;">
            @error('image') <span class="error-text">{{ $message }}</span> @enderror
        </div>

        <div style="display: flex; gap: 15px; justify-content: flex-end; margin-top: 40px; padding-top: 20px; border-top: 1px solid var(--border-color);">
            <a href="{{ route('admin.gallery.index') }}" class="btn" style="background: var(--border-color); color: var(--text-main);">Batal</a>
            <button type="submit" class="btn btn-primary" style="padding: 12px 30px;">Simpan Perubahan</button>
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
