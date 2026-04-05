@extends('admin.layouts.admin')

@section('title', 'Tambah User Admin')

@section('page_title', 'User Management')

@section('content')
<div class="content-header" style="margin-bottom: 25px;">
    <div style="display: flex; align-items: center; gap: 15px;">
        <a href="{{ route('admin.users.index') }}" class="btn" style="background: var(--bg-card); color: var(--text-main);">
            <i class="fas fa-arrow-left"></i>
        </a>
        <h2 style="font-size: 1.5rem; font-weight: 700;">Tambah User Baru</h2>
    </div>
</div>

<div class="card" style="max-width: 600px; margin: 0 auto;">
    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf
        
        <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="text" name="name" value="{{ old('name') }}" required placeholder="E.g. Administrator..." class="@error('name') invalid @enderror">
            @error('name') <span class="error-text">{{ $message }}</span> @enderror
        </div>

        <div class="form-group" style="margin-top: 20px;">
            <label>Email Address</label>
            <input type="email" name="email" value="{{ old('email') }}" required placeholder="email@example.com" class="@error('email') invalid @enderror">
            @error('email') <span class="error-text">{{ $message }}</span> @enderror
        </div>

        <div class="form-group" style="margin-top: 20px;">
            <label>Password</label>
            <input type="password" name="password" required placeholder="Min. 8 karakter" class="@error('password') invalid @enderror">
            @error('password') <span class="error-text">{{ $message }}</span> @enderror
        </div>

        <div class="form-group" style="margin-top: 20px;">
            <label>Konfirmasi Password</label>
            <input type="password" name="password_confirmation" required placeholder="Ulangi password">
        </div>

        <div style="display: flex; gap: 15px; justify-content: flex-end; margin-top: 40px; padding-top: 20px; border-top: 1px solid var(--border-color);">
            <a href="{{ route('admin.users.index') }}" class="btn" style="background: var(--border-color); color: var(--text-main);">Batal</a>
            <button type="submit" class="btn btn-primary">Simpan User</button>
        </div>
    </form>
</div>
@endsection
