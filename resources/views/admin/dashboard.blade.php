@extends('admin.layouts.admin')

@section('title', 'Dashboard')
@section('page_title', 'Ringkasan Dashboard')

@section('content')
<!-- Stats Grid -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-info">
            <h4>Total Buku</h4>
            <h2>{{ $stats['total_books'] }}</h2>
        </div>
        <div class="stat-icon icon-blue">
            <i class="fas fa-book"></i>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-info">
            <h4>Berita & Artikel</h4>
            <h2>{{ $stats['total_news'] }}</h2>
        </div>
        <div class="stat-icon icon-green">
            <i class="fas fa-newspaper"></i>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-info">
            <h4>Event Aktif</h4>
            <h2>{{ $stats['active_events'] }}</h2>
        </div>
        <div class="stat-icon icon-orange">
            <i class="fas fa-calendar-alt"></i>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-info">
            <h4>Pesan Masuk</h4>
            <h2>{{ $stats['unread_messages'] }}</h2>
        </div>
        <div class="stat-icon icon-purple">
            <i class="fas fa-envelope"></i>
        </div>
    </div>
</div>

<div class="content-card">
    <div class="card-header">
        <h3>Statistik Aktivitas</h3>
    </div>
    <canvas id="activityChart" height="100"></canvas>
</div>
@endsection

@section('scripts')
<script>
    const ctx = document.getElementById('activityChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
            datasets: [{
                label: 'Aktivitas Publikasi',
                data: [12, 19, 3, 5, 2, 3],
                borderColor: '#4f46e5',
                tension: 0.4,
                fill: true,
                backgroundColor: 'rgba(79, 70, 229, 0.1)'
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'bottom' }
            },
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
</script>
@endsection
