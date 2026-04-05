@extends('admin.layouts.admin')

@section('title', 'Tambah Buku Baru')

@section('page_title', 'Manajemen Buku')

@section('content')
<div class="content-header" style="margin-bottom: 25px;">
    <div style="display: flex; align-items: center; gap: 15px;">
        <a href="{{ route('admin.books.index') }}" class="btn" style="background: var(--bg-card); color: var(--text-main); padding: 10px 15px;">
            <i class="fas fa-arrow-left"></i>
        </a>
        <h2 style="font-size: 1.5rem; font-weight: 700;">Tambah Buku Baru</h2>
    </div>
</div>

<div class="card" style="max-width: 900px; margin: 0 auto;">
    <form action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="grid-3">
            <div class="form-group">
                <label>Judul Buku</label>
                <input type="text" name="title" value="{{ old('title') }}" required placeholder="Judul buku..." class="@error('title') invalid @enderror">
                @error('title') <span class="error-text">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label>Penulis</label>
                <input type="text" name="author" value="{{ old('author') }}" required placeholder="Nama penulis..." class="@error('author') invalid @enderror">
                @error('author') <span class="error-text">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label>ISBN</label>
                <input type="text" name="isbn" value="{{ old('isbn') }}" placeholder="978-..." class="@error('isbn') invalid @enderror">
                @error('isbn') <span class="error-text">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="grid-2" style="margin-top: 20px;">
            <div class="form-group">
                <label>Kategori</label>
                <input type="text" name="category" value="{{ old('category') }}" placeholder="E.g. Fiksi, Sejarah..." class="@error('category') invalid @enderror">
                @error('category') <span class="error-text">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label>Harga (Rp)</label>
                <input type="number" name="price" value="{{ old('price') }}" placeholder="0" class="@error('price') invalid @enderror">
                @error('price') <span class="error-text">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="form-group" style="margin-top: 20px;">
            <label>Deskripsi</label>
            <textarea name="description" rows="5" placeholder="Sinopsis singkat..." class="@error('description') invalid @enderror">{{ old('description') }}</textarea>
            @error('description') <span class="error-text">{{ $message }}</span> @enderror
        </div>

        <div class="grid-2" style="margin-top: 20px;">
            <div class="form-group">
                <label>Sampul Buku</label>
                <div class="image-preview-wrapper" onclick="document.getElementById('coverInput').click()" style="cursor: pointer;">
                    <div class="preview-placeholder" id="placeholder">
                        <i class="fas fa-cloud-upload-alt"></i>
                        <span>Pilih Sampul Buku</span>
                    </div>
                    <img id="coverPreview" class="preview-img" style="display: none;">
                </div>
                <input type="file" name="cover_image" id="coverInput" accept="image/*" class="@error('cover_image') invalid @enderror" style="display: none;">
                @error('cover_image') <span class="error-text">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label>Status</label>
                <select name="status" class="@error('status') invalid @enderror">
                    <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>Tersedia</option>
                    <option value="out_of_stock" {{ old('status') == 'out_of_stock' ? 'selected' : '' }}>Habis</option>
                    <option value="pre_order" {{ old('status') == 'pre_order' ? 'selected' : '' }}>Pre-Order</option>
                </select>
                @error('status') <span class="error-text">{{ $message }}</span> @enderror
            </div>
        </div>

        <div style="display: flex; gap: 15px; justify-content: flex-end; margin-top: 40px; padding-top: 20px; border-top: 1px solid var(--border-color);">
            <a href="{{ route('admin.books.index') }}" class="btn" style="background: var(--border-color); color: var(--text-main);">Batal</a>
            <button type="submit" class="btn btn-primary" style="padding: 12px 30px;">Simpan Buku</button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    const coverInput = document.getElementById('coverInput');
    const coverPreview = document.getElementById('coverPreview');
    const placeholder = document.getElementById('placeholder');

    if (coverInput) {
        coverInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    coverPreview.src = e.target.result;
                    coverPreview.style.display = 'block';
                    if (placeholder) placeholder.style.display = 'none';
                }
                reader.readAsDataURL(file);
            }
        });
    }
</script>
@endsection
