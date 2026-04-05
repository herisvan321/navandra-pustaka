@extends('admin.layouts.admin')

@section('title', 'Edit User: ' . $user->name)

@section('page_title', 'User Management')

@section('content')
<div class="content-header" style="margin-bottom: 25px;">
    <div style="display: flex; align-items: center; gap: 15px;">
        <a href="{{ route('admin.users.index') }}" class="btn" style="background: var(--bg-card); color: var(--text-main); padding: 10px 15px;">
            <i class="fas fa-arrow-left"></i>
        </a>
        <h2 style="font-size: 1.5rem; font-weight: 700;">Edit User</h2>
    </div>
</div>

<div class="card" style="max-width: 600px; margin: 0 auto;">
    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" required placeholder="E.g. Administrator..." class="@error('name') invalid @enderror">
            @error('name') <span class="error-text">{{ $message }}</span> @enderror
        </div>

        <div class="form-group" style="margin-top: 20px;">
            <label>Email Address</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" required placeholder="email@example.com" class="@error('email') invalid @enderror">
            @error('email') <span class="error-text">{{ $message }}</span> @enderror
        </div>

        <div class="form-group" style="margin-top: 25px; padding: 15px; background: var(--bg-body); border-radius: 8px; border: 1px dashed var(--border-color);">
            <p style="font-size: 0.85rem; color: var(--text-muted); margin-bottom: 15px;">
                <i class="fas fa-info-circle"></i> Kosongkan password jika tidak ingin mengubahnya.
            </p>
            
            <div class="form-group">
                <label>Password Baru</label>
                <input type="password" name="password" placeholder="Min. 8 karakter" class="@error('password') invalid @enderror">
                @error('password') <span class="error-text">{{ $message }}</span> @enderror
            </div>

            <div class="form-group" style="margin-top: 20px;">
                <label>Konfirmasi Password Baru</label>
                <input type="password" name="password_confirmation" placeholder="Ulangi password baru">
            </div>
        </div>

        <div style="display: flex; gap: 15px; justify-content: flex-end; margin-top: 40px; padding-top: 20px; border-top: 1px solid var(--border-color);">
            <a href="{{ route('admin.users.index') }}" class="btn" style="background: var(--border-color); color: var(--text-main);">Batal</a>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection
