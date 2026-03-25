@extends('layouts.public')

@section('content')
<div class="page active" id="page-kontak">
  <section class="section-hero">
    <div class="section-hero-content">
      <div class="section-tag">Hubungi Kami</div>
      <h1 class="section-title">Kami Siap <span class="gold">Membantu Anda</span></h1>
      <p class="section-desc">Hubungi tim Nevandra Pustaka Nusantara untuk konsultasi penerbitan, pertanyaan layanan, atau sekadar berdiskusi tentang karya Anda.</p>
    </div>
  </section>

  <section class="section-pad">
    <div class="container">
      <div class="contact-grid">
        <div class="contact-info">
          <h2>Informasi Kontak</h2>
          <p>Kami beroperasi Senin–Sabtu pukul 08.00–17.00 WIB. Untuk respons lebih cepat, hubungi kami melalui WhatsApp.</p>

          <div class="contact-item">
            <div class="contact-icon">📍</div>
            <div>
              <div class="label">Alamat Kantor</div>
              <div class="value">{{ $profile->address ?? 'Jl. Kalumbuk RT003/RW003, Kuranji, Kota Padang, Sumatera Barat' }}</div>
            </div>
          </div>
          <div class="contact-item">
            <div class="contact-icon">📱</div>
            <div>
              <div class="label">WhatsApp / Telepon</div>
              <div class="value"><a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $profile->phone ?? '085814609558') }}" target="_blank">{{ $profile->phone ?? '085814609558' }}</a></div>
            </div>
          </div>
          <div class="contact-item">
            <div class="contact-icon">✉️</div>
            <div>
              <div class="label">Email</div>
              <div class="value"><a href="mailto:{{ $profile->email ?? 'Nevandra.press@gmail.com' }}">{{ $profile->email ?? 'Nevandra.press@gmail.com' }}</a></div>
            </div>
          </div>

          <div style="margin-top:32px;">
            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $profile->phone ?? '085814609558') }}" target="_blank" class="btn-primary" style="display:inline-flex;">
              💬 Chat WhatsApp Sekarang
            </a>
          </div>
        </div>

        <div class="contact-form">
          <h3>Kirim Pesan</h3>
          @if(session('success'))
          <div class="alert-success" style="display:block; margin-bottom: 20px;">
            {{ session('success') }}
          </div>
          @endif
          
          <form action="{{ route('public.contact.store') }}" method="POST">
            @csrf
            <div class="form-group">
              <label>Nama Lengkap</label>
              <input type="text" name="name" placeholder="Masukkan nama Anda" required>
            </div>
            <div class="form-group">
              <label>Email</label>
              <input type="email" name="email" placeholder="email@contoh.com" required>
            </div>
            <div class="form-group">
              <label>Subjek</label>
              <input type="text" name="subject" placeholder="Subjek pesan">
            </div>
            <div class="form-group">
              <label>Pesan</label>
              <textarea name="message" placeholder="Tuliskan pesan Anda di sini..." required></textarea>
            </div>
            <button type="submit" class="form-submit">Kirim Pesan Sekarang</button>
          </form>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection
