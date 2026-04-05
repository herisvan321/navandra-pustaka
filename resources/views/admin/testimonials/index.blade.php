@extends('admin.layouts.admin')

@section('title', 'Testimonial')
@section('page_title', 'Daftar Testimoni')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Apa Kata Penulis</h3>
        <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Testimoni
        </a>
    </div>

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>Penulis</th>
                    <th>Pekerjaan</th>
                    <th>Rating</th>
                    <th>Komentar</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($testimonials as $item)
                <tr>
                    <td>
                        <div style="display: flex; align-items: center; gap: 10px;">
                            @if($item->avatar_path)
                                <img src="{{ asset('storage/' . $item->avatar_path) }}" alt="{{ $item->name }}" class="img-thumbnail-avatar">
                            @else
                                <div class="img-thumbnail-avatar" style="background: var(--bg-body); display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-user" style="color: var(--text-muted); font-size: 0.8rem; opacity: 0.5;"></i>
                                </div>
                            @endif
                            <strong>{{ $item->name }}</strong>
                        </div>
                    </td>
                    <td>{{ $item->profession ?: '-' }}</td>
                    <td>
                        <div style="color: #fbbf24; font-size: 0.85rem;">
                            @for($i=0; $i<$item->rating; $i++)
                                <i class="fas fa-star"></i>
                            @endfor
                        </div>
                    </td>
                    <td style="max-width: 250px;">
                        <span style="font-size: 0.85rem; color: var(--text-muted); font-style: italic;">
                            "{{ Str::limit($item->content, 80) }}"
                        </span>
                    </td>
                    <td>
                        <span class="label {{ $item->is_active ? 'label-success' : 'label-gray' }}">
                            {{ $item->is_active ? 'Aktif' : 'Non-aktif' }}
                        </span>
                    </td>
                    <td>
                        <div style="display: flex; gap: 8px;">
                            <a href="{{ route('admin.testimonials.edit', $item->id) }}" class="action-btn" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.testimonials.destroy', $item->id) }}" method="POST" class="delete-form" style="display: inline;">
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
                    <td colspan="6" style="text-align: center; padding: 50px 0; color: var(--text-muted);">
                        <i class="fas fa-quote-right" style="font-size: 3rem; display: block; margin-bottom: 15px; opacity: 0.2;"></i>
                        Belum ada testimoni.
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
                title: 'Hapus Testimoni?',
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
