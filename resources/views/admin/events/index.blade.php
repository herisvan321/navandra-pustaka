@extends('admin.layouts.admin')

@section('title', 'Event Menulis')
@section('page_title', 'Daftar Event')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Event Terbaru</h3>
        <a href="{{ route('admin.events.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Event
        </a>
    </div>

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>Judul Event</th>
                    <th>Tipe</th>
                    <th>Deadline</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($events as $event)
                <tr>
                    <td>
                        <strong>{{ $event->title }}</strong>
                    </td>
                    <td>
                        <span style="font-size: 0.85rem; color: var(--text-muted);">
                            {{ $event->type === 'competition' ? 'Kompetisi' : ($event->type === 'webinar' ? 'Webinar' : 'Lainnya') }}
                        </span>
                    </td>
                    <td>
                        @php
                            $deadline = \Carbon\Carbon::parse($event->deadline);
                            $isExpired = $deadline->isPast();
                        @endphp
                        <span style="color: {{ $isExpired ? '#ef4444' : 'inherit' }}; font-weight: {{ $isExpired ? '600' : '400' }};">
                            {{ $deadline->format('d M Y') }}
                            @if($isExpired) <small>(Selesai)</small> @endif
                        </span>
                    </td>
                    <td>
                        <span class="label {{ $event->is_active ? 'label-success' : 'label-gray' }}">
                            {{ $event->is_active ? 'Aktif' : 'Non-aktif' }}
                        </span>
                    </td>
                    <td>
                        <div style="display: flex; gap: 8px;">
                            <a href="{{ route('admin.events.edit', $event->id) }}" class="action-btn" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" class="delete-form" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="action-btn delete-btn" title="Hapus" style="background: none; border: none; cursor: pointer; color: #ef4444;">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align: center; padding: 50px 0; color: var(--text-muted);">
                        <i class="fas fa-calendar-times" style="font-size: 3rem; display: block; margin-bottom: 15px; opacity: 0.2;"></i>
                        Belum ada event menulis.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.querySelectorAll('.delete-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            const form = this.closest('.delete-form');
            Swal.fire({
                title: 'Hapus Event?',
                text: "Data ini akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, Hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>
@endsection
