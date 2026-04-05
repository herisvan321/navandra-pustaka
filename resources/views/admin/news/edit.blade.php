@extends('admin.layouts.admin')

@section('title', 'Edit Berita: ' . $news->title)

@section('styles')
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<style>
    #editor {
        height: 400px;
        background: var(--bg-card);
        color: var(--text-main);
        border-color: var(--border-color);
        border-radius: 0 0 8px 8px;
    }
    .ql-toolbar {
        background: var(--bg-body);
        border-color: var(--border-color) !important;
        border-radius: 8px 8px 0 0;
    }
    .ql-container {
        border-color: var(--border-color) !important;
    }
</style>
@endsection

@section('content')
<div class="content-header" style="margin-bottom: 25px;">
    <div style="display: flex; align-items: center; gap: 15px;">
        <a href="{{ route('admin.news.index') }}" class="btn" style="background: var(--bg-card); color: var(--text-main); padding: 10px 15px;">
            <i class="fas fa-arrow-left"></i>
        </a>
        <h2 style="font-size: 1.5rem; font-weight: 700;">Edit Berita</h2>
    </div>
</div>

<div class="card" style="max-width: 1000px; margin: 0 auto;">
    <form action="{{ route('admin.news.update', $news->id) }}" method="POST" enctype="multipart/form-data" id="newsForm">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label>Judul Berita</label>
            <input type="text" name="title" value="{{ old('title', $news->title) }}" required placeholder="Masukkan judul berita..." class="@error('title') invalid @enderror">
            @error('title') <span class="error-text">{{ $message }}</span> @enderror
        </div>

        <div class="form-group" style="margin-top: 20px;">
            <label>Konten Berita</label>
            <div id="editor">{!! old('content', $news->content) !!}</div>
            <input type="hidden" name="content" id="contentInput">
            @error('content') <span class="error-text">{{ $message }}</span> @enderror
        </div>

        <div class="grid-2" style="margin-top: 20px;">
            <div class="form-group">
                <label>Status</label>
                @php
                    $statusValue = $news->is_published ? 'published' : 'draft';
                @endphp
                <select name="status" class="@error('status') invalid @enderror">
                    <option value="draft" {{ old('status', $statusValue) == 'draft' ? 'selected' : '' }}>Draft (Simpan saja)</option>
                    <option value="published" {{ old('status', $statusValue) == 'published' ? 'selected' : '' }}>Published (Tampilkan ke Publik)</option>
                </select>
                @error('status') <span class="error-text">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label>Gambar Utama</label>
                <div class="image-preview-wrapper" onclick="document.getElementById('imageInput').click()" style="cursor: pointer;">
                    <div class="preview-placeholder" id="placeholder" style="{{ $news->image_path ? 'display: none;' : '' }}">
                        <i class="fas fa-cloud-upload-alt"></i>
                        <span>Pilih Gambar Utama</span>
                    </div>
                    <img id="imagePreview" src="{{ $news->image_path ? asset('storage/' . $news->image_path) : '' }}" class="preview-img" style="{{ $news->image_path ? '' : 'display: none;' }}">
                </div>
                <input type="file" name="image" id="imageInput" accept="image/*" class="@error('image') invalid @enderror" style="display: none;">
                @error('image') <span class="error-text">{{ $message }}</span> @enderror
            </div>
        </div>

        <div style="display: flex; gap: 15px; justify-content: flex-end; margin-top: 40px; padding-top: 20px; border-top: 1px solid var(--border-color);">
            <a href="{{ route('admin.news.index') }}" class="btn" style="background: var(--border-color); color: var(--text-main);">Batal</a>
            <button type="submit" class="btn btn-primary" style="padding: 12px 30px;">Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script>
    const quill = new Quill('#editor', {
        theme: 'snow',
        placeholder: 'Tulis isi berita di sini...',
        modules: {
            toolbar: [
                ['bold', 'italic', 'underline', 'strike'],
                [{ 'header': [1, 2, 3, false] }],
                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                ['link', 'blockquote', 'code-block'],
                ['clean']
            ]
        }
    });

    const form = document.getElementById('newsForm');
    form.onsubmit = function() {
        const contentInput = document.getElementById('contentInput');
        contentInput.value = quill.root.innerHTML;
        if (quill.getText().trim().length === 0) {
            Swal.fire('Oops!', 'Konten berita tidak boleh kosong.', 'warning');
            return false;
        }
        return true;
    };

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
