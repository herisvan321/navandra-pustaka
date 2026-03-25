@extends('layouts.public')

@section('content')
<div class="page active" id="page-testimoni">
  <section class="section-hero">
    <div class="section-hero-content">
      <div class="section-tag">Testimoni</div>
      <h1 class="section-title">Apa Kata <span class="gold">Para Penulis</span></h1>
      <p class="section-desc">Kepuasan penulis adalah prioritas kami. Simak pengalaman mereka selama menerbitkan buku bersama Nevandra Pustaka Nusantara.</p>
    </div>
  </section>

  <section class="section-pad">
    <div class="container">
      <div class="testi-grid">
        @forelse($testimonials as $testi)
        <div class="testi-card">
          <div class="stars">⭐⭐⭐⭐⭐</div>
          <p class="testi-text">"{{ $testi->content }}"</p>
          <div class="testi-author">
            <div class="testi-avatar">
                {{ substr($testi->name, 0, 1) }}
            </div>
            <div>
              <div class="testi-name">{{ $testi->name }}</div>
              <div class="testi-role">{{ $testi->role }}</div>
            </div>
          </div>
        </div>
        @empty
        <div class="testi-card">
          <div class="stars">⭐⭐⭐⭐⭐</div>
          <p class="testi-text">"Proses penerbitan di Nevandra sangat profesional. Tim editornya sangat membantu dalam memperbaiki naskah saya."</p>
          <div class="testi-author">
            <div class="testi-avatar">R</div>
            <div>
              <div class="testi-name">Rina Anggraini</div>
              <div class="testi-role">Penulis Novel</div>
            </div>
          </div>
        </div>
        @endforelse
      </div>
      
      <div class="mt-12">
        {{ $testimonials->links() }}
      </div>
    </div>
  </section>
</div>
@endsection
