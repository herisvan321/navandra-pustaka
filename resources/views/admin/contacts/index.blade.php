@extends('admin.layouts.admin')

@section('title', 'Pesan Masuk')
@section('page_title', 'Inbox Pesan')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Semua Pesan</h3>
    </div>

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>Pengirim</th>
                    <th>Subjek</th>
                    <th>Pesan</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($messages as $msg)
                <tr>
                    <td>
                        <strong>{{ $msg->name }}</strong>
                        <div style="font-size: 0.8rem; color: var(--text-muted);">{{ $msg->email }}</div>
                    </td>
                    <td>{{ $msg->subject }}</td>
                    <td style="max-width: 300px;">
                        <span style="font-size: 0.85rem; color: var(--text-muted);">
                            {{ Str::limit($msg->message, 80) }}
                        </span>
                    </td>
                    <td>{{ $msg->created_at->format('d M Y') }}</td>
                    <td>
                        <div style="display: flex; gap: 8px;">
                            <a href="{{ route('admin.contacts.show', $msg->id) }}" class="action-btn" title="Baca Pesan">
                                <i class="fas fa-envelope-open-text"></i>
                            </a>
                            <form action="{{ route('admin.contacts.destroy', $msg->id) }}" method="POST" class="delete-form" style="display: inline;">
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
                        <i class="fas fa-envelope-open" style="font-size: 3rem; display: block; margin-bottom: 15px; opacity: 0.2;"></i>
                        Belum ada pesan masuk.
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
                title: 'Hapus Pesan?',
                text: "Pesan ini akan dihapus secara permanen!",
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
