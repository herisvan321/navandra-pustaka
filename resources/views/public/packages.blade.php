@extends('layouts.public')

@section('content')
<div class="page active" id="page-paket">
  <section class="section-hero">
    <div class="section-hero-content">
      <div class="section-tag">Paket Penerbitan</div>
      <h1 class="section-title">Pilih Paket yang <span class="gold">Tepat untuk Anda</span></h1>
      <p class="section-desc">Kami menawarkan berbagai paket penerbitan yang dirancang fleksibel untuk semua kebutuhan penulis, dari pemula hingga profesional.</p>
    </div>
  </section>

  <section class="section-pad">
    <div class="container">
      <div class="grid-3">
        @forelse($packages as $package)
        <div class="paket-card {{ $package->is_featured ? 'featured' : '' }}">
          @if($package->is_featured)
          <div class="paket-badge">⭐ Terpopuler</div>
          @endif
          <div class="paket-header">
            <div class="paket-name">{{ $package->name }}</div>
            <div class="paket-tagline">{{ $package->tagline }}</div>
            <div class="paket-price">
              <span class="amount">Rp {{ number_format($package->price, 0, ',', '.') }}</span>
              <span class="period">/ judul</span>
            </div>
          </div>
          <div class="paket-body">
            @php $features = json_decode($package->features, true) ?? []; @endphp
            @foreach($features as $feature)
            <div class="paket-feature">
              <span class="check">✓</span>
              <span>{{ $feature }}</span>
            </div>
            @endforeach
            
            <a href="https://wa.me/6285814609558?text=Halo,%20saya%20tertarik%20dengan%20Paket%20{{ urlencode($package->name) }}%20Nevandra%20Pustaka" 
               target="_blank" 
               class="paket-cta {{ $package->is_featured ? 'primary' : 'secondary' }}" 
               style="display: block; text-align: center; text-decoration: none;">
              Pilih Paket Ini
            </a>
          </div>
        </div>
        @empty
        <!-- Default packages if none in DB -->
        <div class="paket-card">
          <div class="paket-header">
            <div class="paket-name">Paket Digital</div>
            <div class="paket-tagline">Ideal untuk penulis pemula</div>
            <div class="paket-price">
              <span class="amount">Rp 450K</span>
              <span class="period">/ judul</span>
            </div>
          </div>
          <div class="paket-body">
            <div class="paket-feature"><span class="check">✓</span><span>E-Book (PDF & EPUB)</span></div>
            <div class="paket-feature"><span class="check">✓</span><span>Desain Cover Profesional</span></div>
            <div class="paket-feature"><span class="check">✓</span><span>Layout Interior B5</span></div>
            <a href="https://wa.me/6285814609558" class="paket-cta secondary" style="display: block; text-align: center; text-decoration: none;">Pilih Paket Ini</a>
          </div>
        </div>
        @endforelse
      </div>
    </div>
  </section>
</div>
@endsection
