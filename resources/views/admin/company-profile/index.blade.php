@extends('admin.layouts.admin')

@section('title', 'Profil Perusahaan')

@section('page_title', 'Informasi Perusahaan')

@section('content')
<div class="card" style="max-width: 900px; margin: 0 auto;">
    <form action="{{ route('admin.company-profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="grid-2" style="gap: 30px;">
            <!-- Left Column: Basic Info -->
            <div>
                <h3 style="font-size: 1.1rem; font-weight: 700; margin-bottom: 20px; border-bottom: 1px solid var(--border-color); padding-bottom: 10px;">
                    Identitas & Kontak
                </h3>
                
                <div class="form-group">
                    <label>Nama Perusahaan</label>
                    <input type="text" name="name" value="{{ old('name', $profile->name) }}" required class="@error('name') invalid @enderror">
                    @error('name') <span class="error-text">{{ $message }}</span> @enderror
                </div>

                <div class="form-group" style="margin-top: 15px;">
                    <label>Email Perusahaan</label>
                    <input type="email" name="email" value="{{ old('email', $profile->email) }}" required class="@error('email') invalid @enderror">
                    @error('email') <span class="error-text">{{ $message }}</span> @enderror
                </div>

                <div class="form-group" style="margin-top: 15px;">
                    <label>Telepon / WhatsApp</label>
                    <input type="text" name="phone" value="{{ old('phone', $profile->phone) }}" required class="@error('phone') invalid @enderror">
                    @error('phone') <span class="error-text">{{ $message }}</span> @enderror
                </div>

                <div class="form-group" style="margin-top: 15px;">
                    <label>Alamat Kantor</label>
                    <textarea name="address" rows="3" required class="@error('address') invalid @enderror">{{ old('address', $profile->address) }}</textarea>
                    @error('address') <span class="error-text">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Right Column: Branding & Social -->
            <div>
                <h3 style="font-size: 1.1rem; font-weight: 700; margin-bottom: 20px; border-bottom: 1px solid var(--border-color); padding-bottom: 10px;">
                    Media & Sosial
                </h3>

                <div class="form-group">
                    <label>Logo Perusahaan</label>
                    <input type="file" name="logo" id="logoInput" accept="image/*" class="@error('logo') invalid @enderror">
                    <div id="logoPreviewContainer" style="margin-top: 10px;">
                        <img id="logoPreview" src="{{ $profile->logo_path ? asset('storage/' . $profile->logo_path) : '' }}" style="{{ $profile->logo_path ? '' : 'display: none;' }} max-height: 80px; border-radius: 5px; border: 1px solid var(--border-color);">
                    </div>
                    @error('logo') <span class="error-text">{{ $message }}</span> @enderror
                </div>

                <div class="form-group" style="margin-top: 15px;">
                    <label><i class="fab fa-instagram"></i> Instagram URL</label>
                    <input type="url" name="instagram_url" value="{{ old('instagram_url', $profile->instagram_url) }}" placeholder="https://instagram.com/..." class="@error('instagram_url') invalid @enderror">
                </div>

                <div class="form-group" style="margin-top: 15px;">
                    <label><i class="fab fa-facebook"></i> Facebook URL</label>
                    <input type="url" name="facebook_url" value="{{ old('facebook_url', $profile->facebook_url) }}" placeholder="https://facebook.com/..." class="@error('facebook_url') invalid @enderror">
                </div>

                <div class="form-group" style="margin-top: 15px;">
                    <label><i class="fab fa-twitter"></i> Twitter URL</label>
                    <input type="url" name="twitter_url" value="{{ old('twitter_url', $profile->twitter_url) }}" placeholder="https://twitter.com/..." class="@error('twitter_url') invalid @enderror">
                </div>
            </div>
        </div>

        <div style="margin-top: 30px;">
            <h3 style="font-size: 1.1rem; font-weight: 700; margin-bottom: 20px; border-bottom: 1px solid var(--border-color); padding-bottom: 10px;">
                Tentang Kami (Visi & Misi)
            </h3>
            <div class="form-group">
                <textarea name="about" rows="6" placeholder="Ceritakan sejarah atau visi misi perusahaan..." class="@error('about') invalid @enderror">{{ old('about', $profile->about) }}</textarea>
                @error('about') <span class="error-text">{{ $message }}</span> @enderror
            </div>
        </div>

        <div style="display: flex; gap: 15px; justify-content: flex-end; margin-top: 40px; padding-top: 20px; border-top: 1px solid var(--border-color);">
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    const logoInput = document.getElementById('logoInput');
    const logoPreview = document.getElementById('logoPreview');

    if (logoInput) {
        logoInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    logoPreview.src = e.target.result;
                    logoPreview.style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
        });
    }
</script>
@endsection
