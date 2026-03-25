@extends('layouts.public')

@section('content')
<div class="page active" id="page-home">
<!-- HERO -->
<section class="hero">
  <div class="hero-bg-pattern"></div>
  <div class="hero-lines"></div>
  <div class="hero-content">
    <div>
      <div class="hero-badge">Penerbit Terpercaya di Nusantara</div>
      <h1 class="hero-title">
        Wujudkan Karya Terbaik Anda <span class="accent">Bersama Kami</span>
      </h1>
      <p class="hero-desc">
        Nevandra Pustaka Nusantara hadir sebagai mitra strategis dalam menghilirkan gagasan menjadi produk nyata. Dari naskah hingga buku tercetak, kami dampingi setiap langkah perjalanan literasimu.
      </p>
      <div class="hero-actions">
        <a href="{{ route('public.steps') }}" class="btn-primary">
          ✍️ Terbitkan Buku Kamu
        </a>
        <a href="{{ route('public.packages') }}" class="btn-outline">
          📦 Lihat Paket
        </a>
      </div>
      <div class="hero-stats">
        <div class="stat-item">
          <span class="stat-num">500+</span>
          <span class="stat-label">Buku Terbit</span>
        </div>
        <div class="stat-item">
          <span class="stat-num">300+</span>
          <span class="stat-label">Penulis Aktif</span>
        </div>
        <div class="stat-item">
          <span class="stat-num">6</span>
          <span class="stat-label">Fokus Layanan</span>
        </div>
      </div>
    </div>
    <div class="hero-visual">
      <div class="book-stack">
        <div class="book-card"></div>
        <div class="book-card"></div>
        <div class="book-card">
          <div class="book-inner">
            <svg width="40" height="40" viewBox="0 0 40 40" fill="none">
              <rect width="40" height="40" rx="8" fill="rgba(201,168,76,0.15)"/>
              <path d="M8 30V10C8 9 9 8 10 8h14l8 8v14c0 1-1 2-2 2H10c-1 0-2-1-2-2z" stroke="#C9A84C" stroke-width="1.5" fill="none"/>
              <path d="M22 8v8h8" stroke="#C9A84C" stroke-width="1.5" fill="none"/>
              <line x1="12" y1="18" x2="28" y2="18" stroke="#C9A84C" stroke-width="1.5"/>
              <line x1="12" y1="22" x2="28" y2="22" stroke="#C9A84C" stroke-width="1.5"/>
              <line x1="12" y1="26" x2="22" y2="26" stroke="#C9A84C" stroke-width="1.5"/>
            </svg>
            <strong>Nevandra Press</strong>
            <p>Naskah Terbaik<br>Diterbitkan di Sini</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- SERVICES -->
<section class="home-services">
  <div class="container">
    <div class="home-services-header">
      <div class="section-tag">Layanan Unggulan</div>
      <h2>Layanan Lengkap untuk Karya Anda</h2>
      <p>Kami mengintegrasikan proses kreatif hulu ke hilir, dari penulisan hingga distribusi digital dan fisik ke seluruh penjuru nusantara.</p>
    </div>
    <div class="grid-3">
      <div class="service-card fade-in">
        <div class="service-icon">📚</div>
        <h3>Literasi & Penerbitan</h3>
        <p>Penerbitan buku fiksi, non-fiksi, referensi, jurnal ilmiah, buletin, dan majalah dengan standar editorial ketat dan ISBN resmi dari Perpusnas RI.</p>
      </div>
      <div class="service-card fade-in">
        <div class="service-icon">🖨️</div>
        <h3>Percetakan & Penunjang</h3>
        <p>Solusi cetak presisi untuk kebutuhan komersial, institusional, maupun personal. Hasil estetis dan tahan lama dengan infrastruktur percetakan modern.</p>
      </div>
      <div class="service-card fade-in">
        <div class="service-icon">🎨</div>
        <h3>Desain Grafis & Visual</h3>
        <p>Identitas visual yang modern dan regional. Tim desain kami menghadirkan aset kreatif untuk cover buku, layout interior, hingga branding klien.</p>
      </div>
      <div class="service-card fade-in">
        <div class="service-icon">💻</div>
        <h3>Transformasi Digital</h3>
        <p>Pemrograman komputer dan pengelolaan portal web komersial. Kami membangun ekosistem digital untuk memperluas jangkauan konten secara daring.</p>
      </div>
      <div class="service-card fade-in">
        <div class="service-icon">🎓</div>
        <h3>Pendidikan & Pelatihan</h3>
        <p>Program pelatihan literasi dan keterampilan yang relevan dengan industri terkini. Meningkatkan kapasitas penulis dan para profesional.</p>
      </div>
      <div class="service-card fade-in">
        <div class="service-icon">🚚</div>
        <h3>Distribusi & Perdagangan</h3>
        <p>Distributor retail untuk hasil cetakan dan penerbitan. Memastikan rantai distribusi produk sampai ke tangan konsumen secara efektif di seluruh Indonesia.</p>
      </div>
    </div>
  </div>
</section>

<!-- QUOTE -->
<div class="container">
  <div class="highlight-quote">
    <blockquote>"Setiap kata yang kamu tulis adalah benih peradaban yang menunggu untuk tumbuh."</blockquote>
    <cite>— Nevandra Pustaka Nusantara</cite>
  </div>
</div>

<!-- NEWS -->
<section class="home-news">
  <div class="news-wrapper">
    <div class="home-news-header">
      <h2>Berita & Pengumuman</h2>
      <a href="{{ route('public.gallery') }}" class="btn-outline" style="font-size:13px;padding:10px 18px;">Lihat Semua →</a>
    </div>
    <div class="grid-3">
      @forelse($news as $item)
      <div class="news-card">
        <div class="news-img {{ $loop->iteration == 1 ? 'news-img-1' : ($loop->iteration == 2 ? 'news-img-2' : 'news-img-3') }}">
            @if($item->image_path)
                <img src="{{ asset('storage/' . $item->image_path) }}" class="w-full h-full object-cover">
            @else
                📖
            @endif
        </div>
        <div class="news-body">
          <div class="news-meta">📅 {{ $item->created_at->format('d M Y') }} &nbsp;|&nbsp; <span class="badge badge-gold">News</span></div>
          <h3>{{ $item->title }}</h3>
          <p>{{ Str::limit(strip_tags($item->content), 100) }}</p>
        </div>
      </div>
      @empty
      <div class="news-card">
        <div class="news-img news-img-1">📖</div>
        <div class="news-body">
          <div class="news-meta">📅 15 Maret 2025 &nbsp;|&nbsp; <span class="badge badge-gold">Pengumuman</span></div>
          <h3>Pembukaan Antologi Puisi Nasional 2025 "Suara Nusantara"</h3>
          <p>Nevandra Pustaka Nusantara membuka call for writer untuk antologi puisi bertema keberagaman dan kebangsaan.</p>
        </div>
      </div>
      @endforelse
    </div>
  </div>
</section>
</div>
@endsection
