@extends('layouts.public')

@section('content')
<div class="page active" id="page-event">
  <section class="section-hero">
    <div class="section-hero-content">
      <div class="section-tag">Event Menulis</div>
      <h1 class="section-title">Event & <span class="gold">Kompetisi Literasi</span></h1>
      <p class="section-desc">Ikuti berbagai tantangan menulis, perlombaan, dan proyek antologi yang sedang diadakan oleh Nevandra Pustaka Nusantara.</p>
    </div>
  </section>

  <section class="section-pad">
    <div class="container">
      <div style="display:flex;align-items:center;gap:12px;margin-bottom:32px;">
        <span style="width:10px;height:10px;background:#22c55e;border-radius:50%;display:inline-block;animation:pulse 1.5s infinite;"></span>
        <span style="font-weight:600;color:#16a34a;font-size:14px;">Event Sedang Berjalan</span>
      </div>
      <div class="event-grid">
        @forelse($events as $event)
        <div class="event-card">
          <div class="event-header" style="{{ !$event->is_active ? 'background:linear-gradient(135deg,#3d4a5c,#5c6a7c);' : '' }}">
            <div class="event-type" style="{{ !$event->is_active ? 'background:rgba(255,255,255,0.2);color:#fff;' : '' }}">
                {{ $event->is_active ? '🔥 AKTIF' : '⏳ SEGERA' }}
            </div>
            <h3>{{ $event->title }}</h3>
          </div>
          <div class="event-body">
            <div class="event-meta">
              <span>📅 Deadline: {{ $event->deadline ? $event->deadline->format('d M Y') : 'Segera' }}</span>
              <span>👥 {{ $event->type }}</span>
              <span>📝 {{ $event->genre }}</span>
            </div>
            <p>{{ Str::limit(strip_tags($event->description), 150) }}</p>
            
            @if($event->is_active)
            <div style="display:flex;gap:10px;flex-wrap:wrap;margin-top:4px;margin-bottom:16px;">
              <span class="badge badge-gold">Kontributor Mendapat Buku Gratis</span>
              <span class="badge badge-green">Pemenang Uang Tunai</span>
            </div>
            @endif

            <a href="https://wa.me/6285814609558?text=Halo,%20saya%20ingin%20daftar%20{{ urlencode($event->title) }}" 
               target="_blank" 
               class="{{ $event->is_active ? 'btn-primary' : 'btn-outline' }}" 
               style="display:inline-flex;{{ !$event->is_active ? 'border-color:var(--navy);color:var(--navy);' : '' }}font-size:13px;padding:10px 20px;">
               {{ $event->is_active ? 'Daftar Sekarang' : 'Daftar Minat' }}
            </a>
          </div>
        </div>
        @empty
        <div class="col-span-full py-10 text-center text-text-light italic">Belum ada event aktif saat ini.</div>
        @endforelse
      </div>
      
      <div class="mt-12">
        {{ $events->links() }}
      </div>
    </div>
  </section>
</div>
@endsection
