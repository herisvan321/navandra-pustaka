@extends('admin.layouts.admin')

@section('title', 'Tambah FAQ Baru')

@section('page_title', 'FAQ Management')

@section('content')
<div class="content-header" style="margin-bottom: 25px;">
    <div style="display: flex; align-items: center; gap: 15px;">
        <a href="{{ route('admin.faqs.index') }}" class="btn" style="background: var(--bg-card); color: var(--text-main); padding: 10px 15px;">
            <i class="fas fa-arrow-left"></i>
        </a>
        <h2 style="font-size: 1.5rem; font-weight: 700;">Tambah FAQ</h2>
    </div>
</div>

<div class="card" style="max-width: 800px; margin: 0 auto;">
    <form action="{{ route('admin.faqs.store') }}" method="POST">
        @csrf
        
        <div class="form-group">
            <label>Pertanyaan (Question)</label>
            <input type="text" name="question" value="{{ old('question') }}" required placeholder="E.g. Bagaimana cara mengirim naskah?" class="@error('question') invalid @enderror">
            @error('question') <span class="error-text">{{ $message }}</span> @enderror
        </div>

        <div class="form-group" style="margin-top: 20px;">
            <label>Jawaban (Answer)</label>
            <textarea name="answer" rows="6" required placeholder="Tuliskan jawaban lengkap di sini..." class="@error('answer') invalid @enderror">{{ old('answer') }}</textarea>
            @error('answer') <span class="error-text">{{ $message }}</span> @enderror
        </div>

        <div class="form-group" style="margin-top: 25px; display: flex; align-items: center; gap: 10px;">
            <input type="checkbox" name="is_active" id="isActive" {{ old('is_active', true) ? 'checked' : '' }} style="width: auto;">
            <label for="isActive" style="margin-bottom: 0; cursor: pointer;">Aktifkan (Tampilkan di Website)</label>
        </div>

        <div style="display: flex; gap: 15px; justify-content: flex-end; margin-top: 40px; padding-top: 20px; border-top: 1px solid var(--border-color);">
            <a href="{{ route('admin.faqs.index') }}" class="btn" style="background: var(--border-color); color: var(--text-main);">Batal</a>
            <button type="submit" class="btn btn-primary">Simpan FAQ</button>
        </div>
    </form>
</div>
@endsection
