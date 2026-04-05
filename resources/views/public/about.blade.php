@extends('layouts.public')

@section('content')
<div class="page active" id="page-tentang">
  <section class="section-hero">
    <div class="section-hero-content">
      <div class="section-tag">Tentang Kami</div>
      <h1 class="section-title">Mengenal <span class="gold">Nevandra Pustaka Nusantara</span></h1>
      <p class="section-desc">Perusahaan multisektoral yang bergerak di bidang literasi, penerbitan, percetakan, teknologi informasi, dan pengembangan sumber daya manusia.</p>
    </div>
  </section>

  <section class="section-pad">
    <div class="container">
      <div class="about-grid">
        <div class="about-visual">
          <div class="about-img-wrap">
            <span class="about-img-icon">📚</span>
          </div>
          <div class="about-stat-badge">
            <span class="num">2026</span>
            <span class="lbl">Tahun Berdiri</span>
          </div>
        </div>
        <div class="about-text">
          <h2>Mitra Literasi Terpercaya di Nusantara</h2>
          <p>{{ $profile->about ?? 'CV Nevandra Pustaka Nusantara adalah perusahaan multisektoral yang bergerak di bidang literasi, penerbitan, percetakan, teknologi informasi, dan pengembangan sumber daya manusia.' }}</p>
          <!-- <p>Berlandaskan semangat inovasi dan dedikasi terhadap penyebaran ilmu pengetahuan, kami hadir sebagai mitra strategis dalam menghilirkan gagasan menjadi produk nyata yang bernilai tinggi.</p> -->
          <a href="{{ route('public.contact') }}" class="btn-primary" style="margin-top:8px;">📞 Hubungi Kami</a>
        </div>
      </div>

      <div class="divider"></div>

      <div class="visi-misi">
        <div class="vm-card">
          <div class="vm-icon">🔭</div>
          <h3>Visi Perusahaan</h3>
          <p>{{ $profile->vision ?? 'Menjadi pusat keunggulan literasi dan inovasi digital di Indonesia yang mampu menginspirasi serta mencerdaskan kehidupan bangsa.' }}</p>
        </div>
        <div class="vm-card">
          <div class="vm-icon">🎯</div>
          <h3>Misi Perusahaan</h3>
          <p>{{ $profile->mission ?? 'Memberikan layanan penerbitan dan percetakan berkualitas tinggi, mengadopsi teknologi digital untuk perluasan akses informasi, serta berkontribusi aktif dalam pengembangan pendidikan kreatif.' }}</p>
        </div>
      </div>

      <div class="divider"></div>

      <div style="text-align:center;margin-bottom:36px;">
        <div class="section-tag">Fokus Layanan</div>
        <h2 style="font-family:'Playfair Display',serif;font-size:32px;font-weight:900;color:var(--navy);margin-top:12px;">6 Pilar Layanan Utama</h2>
      </div>

      <div class="grid-3">
        <div class="service-card">
          <div class="service-icon">📚</div>
          <h3>1. Literasi & Penerbitan Terpadu</h3>
          <p>Penerbitan buku fiksi, non-fiksi, referensi, jurnal ilmiah, buletin, dan majalah dengan standar editorial ketat dan kredibilitas nasional.</p>
        </div>
        <div class="service-card">
          <div class="service-icon">🖨️</div>
          <h3>2. Industri Percetakan</h3>
          <p>Solusi cetak presisi untuk kebutuhan komersial, institusional, dan personal dengan infrastruktur percetakan umum dan khusus yang modern.</p>
        </div>
        <div class="service-card">
          <div class="service-icon">🎨</div>
          <h3>3. Desain Grafis & Visual</h3>
          <p>Tim desain yang menghadirkan aset visual modern dan regional dengan sentuhan profesional untuk memperkuat branding klien.</p>
        </div>
        <div class="service-card">
          <div class="service-icon">💻</div>
          <h3>4. Transformasi Digital & TI</h3>
          <p>Pemrograman komputer dan pengelolaan portal web komersial. Membangun ekosistem digital mandiri untuk konten dan produk.</p>
        </div>
        <div class="service-card">
          <div class="service-icon">🎓</div>
          <h3>5. Pendidikan & Pelatihan</h3>
          <p>Program pelatihan kapasitas literasi dan keterampilan masyarakat yang relevan dengan perkembangan industri terkini.</p>
        </div>
        <div class="service-card">
          <div class="service-icon">🚚</div>
          <h3>6. Distribusi & Perdagangan</h3>
          <p>Distributor retail untuk hasil cetakan dan penerbitan, memastikan rantai distribusi produk sampai ke tangan konsumen dengan efektif.</p>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection
