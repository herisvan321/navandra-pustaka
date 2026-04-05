@extends('admin.layouts.admin')

@section('title', 'Alur Penerbitan')
@section('page_title', 'Daftar Langkah')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Tahapan Penerbitan</h3>
        <a href="{{ route('admin.publishing-steps.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Langkah
        </a>
    </div>

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th style="width: 80px;">Urutan</th>
                    <th>Judul Langkah</th>
                    <th>Deskripsi</th>
                    <th>Catatan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($steps as $step)
                <tr>
                    <td style="text-align: center;">
                        <span style="font-weight: 700; background: var(--bg-body); padding: 5px 12px; border-radius: 5px; border: 1px solid var(--border-color);">
                            {{ $step->order }}
                        </span>
                    </td>
                    <td><strong>{{ $step->title }}</strong></td>
                    <td style="max-width: 300px;">
                        <span style="font-size: 0.85rem; color: var(--text-muted);">
                            {{ Str::limit($step->description, 100) }}
                        </span>
                    </td>
                    <td>
                        <i class="fas fa-info-circle" style="color: var(--text-muted); margin-right: 5px;"></i>
                        <span style="font-size: 0.85rem;">{{ $step->note ?: '-' }}</span>
                    </td>
                    <td>
                        <div style="display: flex; gap: 8px;">
                            <a href="{{ route('admin.publishing-steps.edit', $step->id) }}" class="action-btn" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.publishing-steps.destroy', $step->id) }}" method="POST" class="delete-form" style="display: inline;">
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
                        <i class="fas fa-project-diagram" style="font-size: 3rem; display: block; margin-bottom: 15px; opacity: 0.2;"></i>
                        Belum ada tahapan alur penerbitan.
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
                title: 'Hapus Langkah?',
                text: "Langkah ini akan dihapus dari alur penerbitan!",
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
