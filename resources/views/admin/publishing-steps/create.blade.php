@extends('admin.layouts.admin')

@section('title', 'Tambah Langkah Penerbitan')

@section('page_title', 'Alur Penerbitan')

@section('content')
<div class="content-header" style="margin-bottom: 25px;">
    <div style="display: flex; align-items: center; gap: 15px;">
        <a href="{{ route('admin.publishing-steps.index') }}" class="btn" style="background: var(--bg-card); color: var(--text-main); padding: 10px 15px;">
            <i class="fas fa-arrow-left"></i>
        </a>
        <h2 style="font-size: 1.5rem; font-weight: 700;">Tambah Langkah Baru</h2>
    </div>
</div>

<div class="card" style="max-width: 800px; margin: 0 auto;">
    <form action="{{ route('admin.publishing-steps.store') }}" method="POST">
        @csrf
        
        <div class="grid-2" style="margin-top: 20px;">
            <div class="form-group">
                <label>Judul Langkah</label>
                <input type="text" name="title" value="{{ old('title') }}" required placeholder="E.g. Kirim Naskah, Review Editor..." class="@error('title') invalid @enderror">
                @error('title') <span class="error-text">{{ $message }}</span> @enderror
            </div>
            <div class="form-group" style="max-width: 150px;">
                <label>Urutan (Order)</label>
                <input type="number" name="order" value="{{ old('order', 0) }}" required placeholder="0" class="@error('order') invalid @enderror">
                @error('order') <span class="error-text">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="form-group" style="margin-top: 20px;">
            <label>Deskripsi Langkah</label>
            <textarea name="description" rows="4" required placeholder="Jelaskan apa yang dilakukan pada tahap ini..." class="@error('description') invalid @enderror">{{ old('description') }}</textarea>
            @error('description') <span class="error-text">{{ $message }}</span> @enderror
        </div>

        <div class="form-group" style="margin-top: 20px;">
            <label>Catatan Tambahan (Opsional)</label>
            <input type="text" name="note" value="{{ old('note') }}" placeholder="E.g. Estimasi 2-3 hari..." class="@error('note') invalid @enderror">
            @error('note') <span class="error-text">{{ $message }}</span> @enderror
        </div>

        <div style="display: flex; gap: 15px; justify-content: flex-end; margin-top: 40px; padding-top: 20px; border-top: 1px solid var(--border-color);">
            <a href="{{ route('admin.publishing-steps.index') }}" class="btn" style="background: var(--border-color); color: var(--text-main);">Batal</a>
            <button type="submit" class="btn btn-primary">Simpan Langkah</button>
        </div>
    </form>
</div>
@endsection
