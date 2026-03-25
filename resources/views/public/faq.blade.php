@extends('layouts.public')

@section('content')
<div class="page active" id="page-faq">
  <section class="section-hero">
    <div class="section-hero-content">
      <div class="section-tag">FAQ</div>
      <h1 class="section-title">Pertanyaan yang Sering <span class="gold">Ditanyakan</span></h1>
      <p class="section-desc">Temukan jawaban atas berbagai pertanyaan seputar layanan penerbitan, proses cetak, dan distribusi buku di Nevandra Pustaka Nusantara.</p>
    </div>
  </section>

  <section class="section-pad">
    <div class="container">
      <div class="faq-list">
        @forelse($faqs as $faq)
        <div class="faq-item" onclick="toggleFaq(this)">
          <div class="faq-question">
            <span class="faq-q-text">{{ $faq->question }}</span>
            <span class="faq-icon">+</span>
          </div>
          <div class="faq-answer">
            <p>{{ $faq->answer }}</p>
          </div>
        </div>
        @empty
        <div class="faq-item" onclick="toggleFaq(this)">
          <div class="faq-question">
            <span class="faq-q-text">Berapa lama proses penerbitan buku dari naskah hingga cetak?</span>
            <span class="faq-icon">+</span>
          </div>
          <div class="faq-answer">
            <p>Proses penerbitan buku di Nevandra Pustaka Nusantara umumnya membutuhkan waktu 14–30 hari kerja, tergantung paket yang dipilih. Paket Premium memiliki jalur prioritas dengan estimasi 14 hari, sedangkan paket Reguler sekitar 21–30 hari.</p>
          </div>
        </div>
        @endforelse
      </div>
    </div>
  </section>
</div>

<script>
    function toggleFaq(el) {
        el.classList.toggle('open');
    }
</script>
@endsection
