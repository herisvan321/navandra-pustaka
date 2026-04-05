@extends('admin.layouts.admin')

@section('title', 'Edit Testimoni: ' . $testimonial->name)

@section('page_title', 'Testimonial')

@section('content')
<div class="content-header" style="margin-bottom: 25px;">
    <div style="display: flex; align-items: center; gap: 15px;">
        <a href="{{ route('admin.testimonials.index') }}" class="btn" style="background: var(--bg-card); color: var(--text-main); padding: 10px 15px;">
            <i class="fas fa-arrow-left"></i>
        </a>
        <h2 style="font-size: 1.5rem; font-weight: 700;">Edit Testimoni</h2>
    </div>
</div>

<div class="card" style="max-width: 800px; margin: 0 auto;">
    <form action="{{ route('admin.testimonials.update', $testimonial->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="grid-2">
            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name', $testimonial->name) }}" required placeholder="E.g. John Doe..." class="@error('name') invalid @enderror">
                @error('name') <span class="error-text">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label>Pekerjaan / Instansi</label>
                <input type="text" name="profession" value="{{ old('profession', $testimonial->profession) }}" placeholder="E.g. Penulis, Dosen..." class="@error('profession') invalid @enderror">
                @error('profession') <span class="error-text">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="form-group" style="margin-top: 20px;">
            <label>Isi Testimoni</label>
            <textarea name="content" rows="4" required placeholder="Apa kata mereka tentang Nevandra Pustaka?" class="@error('content') invalid @enderror">{{ old('content', $testimonial->content) }}</textarea>
            @error('content') <span class="error-text">{{ $message }}</span> @enderror
        </div>

        <div class="grid-2" style="margin-top: 20px;">
            <div class="form-group">
                <label>Rating (1-5)</label>
                <select name="rating" class="@error('rating') invalid @enderror">
                    <option value="5" {{ old('rating', $testimonial->rating) == '5' ? 'selected' : '' }}>⭐⭐⭐⭐⭐ (5 - Sangat Puas)</option>
                    <option value="4" {{ old('rating', $testimonial->rating) == '4' ? 'selected' : '' }}>⭐⭐⭐⭐ (4 - Puas)</option>
                    <option value="3" {{ old('rating', $testimonial->rating) == '3' ? 'selected' : '' }}>⭐⭐⭐ (3 - Cukup)</option>
                    <option value="2" {{ old('rating', $testimonial->rating) == '2' ? 'selected' : '' }}>⭐⭐ (2 - Kurang)</option>
                    <option value="1" {{ old('rating', $testimonial->rating) == '1' ? 'selected' : '' }}>⭐ (1 - Buruk)</option>
                </select>
                @error('rating') <span class="error-text">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label>Foto Profil (Avatar)</label>
                <div class="image-preview-wrapper preview-avatar" onclick="document.getElementById('avatarInput').click()" style="cursor: pointer;">
                    <div class="preview-placeholder" id="placeholder" style="{{ $testimonial->avatar_path ? 'display: none;' : '' }}">
                        <i class="fas fa-user-circle"></i>
                        <span>Pilih Foto</span>
                    </div>
                    <img id="avatarPreview" src="{{ $testimonial->avatar_path ? asset('storage/' . $testimonial->avatar_path) : '' }}" class="preview-img" style="{{ $testimonial->avatar_path ? '' : 'display: none;' }}">
                </div>
                <input type="file" name="avatar" id="avatarInput" accept="image/*" class="@error('avatar') invalid @enderror" style="display: none;">
                @error('avatar') <span class="error-text">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="form-group" style="margin-top: 25px; display: flex; align-items: center; gap: 10px;">
            <input type="checkbox" name="is_active" id="isActive" {{ old('is_active', $testimonial->is_active) ? 'checked' : '' }} style="width: auto;">
            <label for="isActive" style="margin-bottom: 0; cursor: pointer;">Aktifkan (Tampilkan di Website)</label>
        </div>

        <div style="display: flex; gap: 15px; justify-content: flex-end; margin-top: 40px; padding-top: 20px; border-top: 1px solid var(--border-color);">
            <a href="{{ route('admin.testimonials.index') }}" class="btn" style="background: var(--border-color); color: var(--text-main);">Batal</a>
            <button type="submit" class="btn btn-primary" style="padding: 12px 30px;">Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    const avatarInput = document.getElementById('avatarInput');
    const avatarPreview = document.getElementById('avatarPreview');
    const placeholder = document.getElementById('placeholder');

    if (avatarInput) {
        avatarInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    avatarPreview.src = e.target.result;
                    avatarPreview.style.display = 'block';
                    if (placeholder) placeholder.style.display = 'none';
                }
                reader.readAsDataURL(file);
            }
        });
    }
</script>
@endsection
