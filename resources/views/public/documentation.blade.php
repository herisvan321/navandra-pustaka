@extends('layouts.public')

@section('content')
<div class="page active" id="page-dokumentasi">
  <section class="section-hero">
    <div class="section-hero-content">
      <div class="section-tag">Dokumentasi Event</div>
      <h1 class="section-title">Arsip <span class="gold">Kegiatan Kami</span></h1>
      <p class="section-desc">Rekam jejak berbagai kegiatan Nevandra Pustaka Nusantara — peluncuran buku, bedah buku, seminar, dan workshop kepenulisan.</p>
    </div>
  </section>

  <section class="section-pad">
    <div class="container">
      <div class="doc-timeline">
        @forelse($news as $item)
        <div class="doc-item">
          <div class="doc-thumb" style="background:linear-gradient(135deg,var(--navy),var(--navy-light));">
            {{ $loop->iteration % 2 == 0 ? '🏆' : '📖' }}
          </div>
          <div class="doc-info">
            <h4>{{ $item->title }}</h4>
            <div class="meta">📅 {{ $item->created_at->format('d M Y') }} &nbsp;|&nbsp; 📍 Nevandra Pustaka Nusantara</div>
            <p>{{ strip_tags($item->content) }}</p>
          </div>
        </div>
        @empty
        <div class="text-center py-10 text-text-light italic">Belum ada dokumentasi event.</div>
        @endforelse
      </div>

      <div class="mt-12">
        {{ $news->links() }}
      </div>
    </div>
  </section>
</div>
@endsection
