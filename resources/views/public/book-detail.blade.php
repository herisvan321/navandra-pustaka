@extends('layouts.public')

@section('content')
<div class="page active" id="page-book-detail">
  <!-- Section Hero (Minimalist) -->
  <section class="section-hero" style="padding: 100px 24px 60px;">
    <div class="section-hero-content">
      <div class="section-tag">Detail Koleksi</div>
      <h1 class="section-title">Informasi <span class="gold">Lengkap Buku</span></h1>
    </div>
  </section>

  <section class="section-pad">
    <div class="container">
      <!-- Back Button -->
      <div style="margin-bottom: 30px;">
        <a href="{{ route('public.books') }}" style="display: inline-flex; align-items: center; gap: 8px; color: var(--gold); text-decoration: none; font-size: 14px; font-weight: 600;">
          ← Kembali ke Katalog
        </a>
      </div>

      <div class="grid-2" style="grid-template-columns: 1fr 1.5fr; gap: 48px; align-items: start;">
        
        <!-- Left: Book Cover (Clean) -->
        <div>
          <div class="card" style="padding: 24px; background: var(--off-white); display: flex; justify-content: center; align-items: center; min-height: 400px; border: 1.5px solid var(--border);">
            @if($book->cover_image)
                <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}" style="width: 100%; height: auto; border-radius: var(--radius); box-shadow: var(--shadow);">
            @else
                <div style="font-size: 120px;">📕</div>
            @endif
          </div>
        </div>

        <!-- Right: Book Details (Neat) -->
        <div class="book-detail-info">
          <div class="badge badge-gold" style="margin-bottom: 16px;">{{ $book->category ?? 'Literatur' }}</div>
          
          <h1 style="font-family: 'Playfair Display', serif; font-size: 36px; font-weight: 900; color: var(--navy); margin-bottom: 8px; line-height: 1.2;">
            {{ $book->title }}
          </h1>
          
          <div style="font-size: 18px; color: var(--text-mid); margin-bottom: 32px;">
            Penulis: <span style="font-weight: 700; color: var(--navy);">{{ $book->author }}</span>
          </div>

          <div style="background: var(--white); border: 1.5px solid var(--border); border-radius: var(--radius); padding: 32px; margin-bottom: 40px; box-shadow: 0 4px 20px rgba(11,29,58,0.04);">
            <div style="margin-bottom: 24px;">
                <div style="font-size: 14px; color: var(--text-light); margin-bottom: 4px;">Harga Buku</div>
                <div style="font-family: 'Playfair Display', serif; font-size: 28px; font-weight: 900; color: var(--gold);">
                    Rp {{ number_format($book->price, 0, ',', '.') }}
                </div>
            </div>

            <a href="https://wa.me/6285814609558?text=Halo%20Nevandra,%20saya%20ingin%20memesan%20buku%20'{{ urlencode($book->title) }}'" 
               target="_blank" 
               class="btn-primary" 
               style="display: flex; justify-content: center; width: 100%; text-decoration: none;">
               Beli Sekarang via WhatsApp
            </a>
            <div style="text-align: center; margin-top: 12px; font-size: 12px; color: var(--text-light);">
                Pesan langsung ke admin untuk pengiriman cepat
            </div>
          </div>

          <!-- Description Section -->
          <div style="margin-bottom: 40px;">
            <h3 style="font-family: 'Playfair Display', serif; font-size: 22px; font-weight: 700; color: var(--navy); margin-bottom: 16px; border-bottom: 2px solid var(--border); padding-bottom: 8px;">
                Deskripsi Buku
            </h3>
            <p style="font-size: 15px; color: var(--text-mid); line-height: 1.8; white-space: pre-line;">
                {{ $book->description ?: 'Buku berkualitas terbitan Nevandra Pustaka Nusantara. Menghadirkan karya literasi yang inspiratif dan mendidik bagi pembaca dari berbagai kalangan.' }}
            </p>
          </div>

          <!-- Metadata Grid -->
          <div class="grid-2" style="gap: 20px;">
            <div style="padding: 16px; background: var(--off-white); border-radius: 12px;">
                <div style="font-size: 12px; color: var(--text-light); margin-bottom: 4px;">Nomor ISBN</div>
                <div style="font-weight: 700; color: var(--navy);">{{ $book->isbn ?: '-' }}</div>
            </div>
            <div style="padding: 16px; background: var(--off-white); border-radius: 12px;">
                <div style="font-size: 12px; color: var(--text-light); margin-bottom: 4px;">Penerbit</div>
                <div style="font-weight: 700; color: var(--navy);">Nevandra Pustaka</div>
            </div>
          </div>
        </div>
      </div>

      <!-- Related Books Section -->
      @if($relatedBooks->count() > 0)
      <div class="divider"></div>
      <div style="text-align: center; margin-bottom: 40px;">
        <h2 style="font-family: 'Playfair Display', serif; font-size: 32px; font-weight: 900; color: var(--navy);">Buku <span class="gold">Terkait</span></h2>
      </div>

      <div class="book-grid">
        @foreach($relatedBooks as $related)
        <div class="book-item">
          <a href="{{ route('public.books.show', $related->id) }}" style="text-decoration: none; color: inherit;">
            <div class="book-cover" style="background:linear-gradient(135deg,#1a3260,#2a4f8c);">
                @if($related->cover_image)
                    <img src="{{ asset('storage/' . $related->cover_image) }}" class="w-full h-full object-cover">
                @else
                    📕
                @endif
            </div>
            <div class="book-info">
              <h4>{{ $related->title }}</h4>
              <div class="author">{{ $related->author }}</div>
              <div class="price">Rp {{ number_format($related->price, 0, ',', '.') }}</div>
            </div>
          </a>
        </div>
        @endforeach
      </div>
      @endif
    </div>
  </section>
</div>

<style>
  @media (max-width: 991px) {
    .grid-2 { grid-template-columns: 1fr !important; }
    .section-hero { padding: 80px 24px 40px !important; }
  }
</style>
@endsection
