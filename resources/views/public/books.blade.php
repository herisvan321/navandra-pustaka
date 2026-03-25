@extends('layouts.public')

@section('content')
<div class="page active" id="page-belanja">
  <section class="section-hero">
    <div class="section-hero-content">
      <div class="section-tag">Toko Buku</div>
      <h1 class="section-title">Katalog <span class="gold">Buku Pilihan</span></h1>
      <p class="section-desc">Temukan koleksi buku berkualitas terbitan Nevandra Pustaka Nusantara. Dari fiksi, non-fiksi, hingga buku referensi akademik.</p>
    </div>
  </section>

  <section class="section-pad">
    <div class="container">
      <div class="shop-filter">
        <button class="filter-btn active" onclick="filterBook(this, 'all')">Semua Koleksi</button>
        <button class="filter-btn" onclick="filterBook(this, 'Fiksi')">Fiksi</button>
        <button class="filter-btn" onclick="filterBook(this, 'Non-Fiksi')">Non-Fiksi</button>
        <button class="filter-btn" onclick="filterBook(this, 'Puisi')">Puisi</button>
        <button class="filter-btn" onclick="filterBook(this, 'Akademik')">Akademik</button>
      </div>

      <div class="book-grid" id="bookGrid">
        @forelse($books as $book)
        <div class="book-item" data-cat="{{ $book->category }}">
          <div class="book-cover" style="background:linear-gradient(135deg,#1a3260,#2a4f8c);">
            @if($book->cover_image)
                <img src="{{ asset('storage/' . $book->cover_image) }}" class="w-full h-full object-cover">
            @else
                📕
            @endif
          </div>
          <div class="book-info">
            <h4>{{ $book->title }}</h4>
            <div class="author">{{ $book->author }}</div>
            <div class="badge badge-gold" style="margin-bottom:8px;">{{ $book->category ?? 'Buku' }}</div>
            <div class="price">Rp {{ number_format($book->price, 0, ',', '.') }}</div>
            <a href="https://wa.me/6285814609558?text=Halo,%20saya%20ingin%20membeli%20buku%20{{ urlencode($book->title) }}" 
               target="_blank" 
               class="book-buy-btn" 
               style="display: block; text-align: center; text-decoration: none;">
               Beli Sekarang
            </a>
          </div>
        </div>
        @empty
        <div class="col-span-full py-10 text-center text-text-light italic">Belum ada buku tersedia.</div>
        @endforelse
      </div>
      
      <div class="mt-12">
        {{ $books->links() }}
      </div>
    </div>
  </section>
</div>

<script>
  function filterBook(btn, cat) {
    document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');

    document.querySelectorAll('.book-item').forEach(item => {
      if (cat === 'all' || item.dataset.cat === cat) {
        item.style.display = 'block';
      } else {
        item.style.display = 'none';
      }
    });
  }
</script>
@endsection
