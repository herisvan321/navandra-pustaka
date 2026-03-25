@extends('layouts.public')

@section('content')
<div class="page active" id="page-galeri">
  <section class="section-hero">
    <div class="section-hero-content">
      <div class="section-tag">Galeri Foto</div>
      <h1 class="section-title">Dokumentasi <span class="gold">Kegiatan Literasi</span></h1>
      <p class="section-desc">Kumpulan momen berharga dalam perjalanan literasi kami bersama para penulis, komunitas, dan mitra strategis.</p>
    </div>
  </section>

  <section class="section-pad">
    <div class="container">
      <div class="pill-tabs">
        <button class="pill-tab active">Semua</button>
        <button class="pill-tab">Event</button>
        <button class="pill-tab">Workshop</button>
        <button class="pill-tab">Percetakan</button>
        <button class="pill-tab">Peluncuran Buku</button>
      </div>
      <div class="gallery-grid">
        @forelse($galleries as $gallery)
        <div class="gallery-item g{{ ($loop->index % 8) + 1 }}">
          @if($gallery->image_path)
          <img src="{{ asset('storage/' . $gallery->image_path) }}" class="w-full h-full object-cover">
          @else
          📸
          @endif
          <div class="gallery-overlay">
            <p>{{ $gallery->title }}</p>
          </div>
        </div>
        @empty
        <div class="gallery-item g1">📸<div class="gallery-overlay"><p>Workshop Penulisan Padang</p></div></div>
        <div class="gallery-item g2">📸<div class="gallery-overlay"><p>Peluncuran Buku Antologi</p></div></div>
        <div class="gallery-item g3">📸<div class="gallery-overlay"><p>Kunjungan Sekolah Literasi</p></div></div>
        <div class="gallery-item g4">📸<div class="gallery-overlay"><p>Tim Redaksi Nevandra</p></div></div>
        @endforelse
      </div>
      
      <div class="mt-12">
        {{ $galleries->links() }}
      </div>
    </div>
  </section>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.pill-tab').forEach(btn => {
      btn.addEventListener('click', function() {
        document.querySelectorAll('.pill-tab').forEach(b => b.classList.remove('active'));
        this.classList.add('active');
      });
    });
  });
</script>
@endsection
