@extends('layouts.public')

@section('content')
<div class="page active" id="page-terbitkan">
  <section class="section-hero">
    <div class="section-hero-content">
      <div class="section-tag">Terbitkan Buku</div>
      <h1 class="section-title">Panduan <span class="gold">Menerbitkan Buku</span></h1>
      <p class="section-desc">Ikuti langkah-langkah berikut untuk mengirimkan naskah dan menerbitkan buku Anda bersama Nevandra Pustaka Nusantara.</p>
    </div>
  </section>

  <section class="section-pad">
    <div class="container">
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:60px;align-items:flex-start;">
        <div>
          <div class="steps-timeline">
            @forelse($steps as $step)
            <div class="step-item">
              <div class="step-num">{{ $loop->iteration }}</div>
              <div class="step-content">
                <h3>{{ $step->title }}</h3>
                <p>{{ $step->description }}</p>
                @if($step->note)
                <div class="step-note">💡 {{ $step->note }}</div>
                @endif
              </div>
            </div>
            @empty
            <div class="step-item">
              <div class="step-num">1</div>
              <div class="step-content">
                <h3>Persiapkan Naskah Anda</h3>
                <p>Pastikan naskah sudah selesai dan tersimpan dalam format Word (.docx) atau Google Docs. Naskah minimal 50 halaman A5.</p>
              </div>
            </div>
            @endforelse
          </div>
        </div>
        <div>
          <div class="card" style="padding:32px;margin-bottom:24px;">
            <h3 style="font-family:'Playfair Display',serif;font-size:20px;font-weight:700;color:var(--navy);margin-bottom:20px;">📋 Syarat & Ketentuan Naskah</h3>
            <div style="font-size:14px;color:var(--text-mid);line-height:1.8;">
              <p style="margin-bottom:10px;">✅ Naskah adalah karya original penulis</p>
              <p style="margin-bottom:10px;">✅ Belum pernah diterbitkan oleh penerbit lain</p>
              <p style="margin-bottom:10px;">✅ Minimal 50 halaman ukuran A5</p>
              <p style="margin-bottom:10px;">✅ Bahasa Indonesia baku / daerah beserta terjemahan</p>
              <p style="margin-bottom:10px;">✅ Tidak mengandung SARA, pornografi, atau melanggar hukum</p>
            </div>
          </div>
          <div class="card" style="padding:32px;">
            <h3 style="font-family:'Playfair Display',serif;font-size:20px;font-weight:700;color:var(--navy);margin-bottom:16px;">🚀 Kirim Naskah Sekarang</h3>
            <p style="font-size:14px;color:var(--text-mid);margin-bottom:20px;line-height:1.7;">Siap menerbitkan karya Anda? Hubungi kami langsung melalui WhatsApp untuk konsultasi gratis!</p>
            <a href="https://wa.me/6285814609558" target="_blank" class="btn-primary" style="width:100%;justify-content:center;display:flex;">
              💬 Konsultasi via WhatsApp
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection
