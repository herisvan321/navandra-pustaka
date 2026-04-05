@extends('admin.layouts.admin')

@section('title', 'Berita & Artikel')
@section('page_title', 'Daftar Berita')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Semua Artikel</h3>
        <a href="{{ route('admin.news.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tulis Berita
        </a>
    </div>

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>Gambar</th>
                    <th>Judul</th>
                    <th>Status</th>
                    <th>Tanggal Terbit</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($news as $item)
                <tr>
                    <td>
                        @if($item->image_path)
                            <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->title }}" class="img-thumbnail-medium">
                        @else
                            <div class="img-thumbnail-medium" style="display: flex; align-items: center; justify-content: center; background: var(--bg-body);">
                                <i class="fas fa-image" style="color: var(--text-muted); opacity: 0.5;"></i>
                            </div>
                        @endif
                    </td>
                    <td>
                        <strong>{{ $item->title }}</strong>
                        <div style="font-size: 0.8rem; color: var(--text-muted);">/{{ $item->slug }}</div>
                    </td>
                    <td>
                        <span class="label {{ $item->is_published ? 'label-success' : 'label-warning' }}">
                            {{ $item->is_published ? 'Published' : 'Draft' }}
                        </span>
                    </td>
                    <td>{{ $item->published_at ? $item->published_at->format('d M Y') : '-' }}</td>
                    <td>
                        <div style="display: flex; gap: 8px;">
                            <a href="{{ route('admin.news.edit', $item->id) }}" class="action-btn" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.news.destroy', $item->id) }}" method="POST" class="delete-form" style="display: inline;">
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
                        <i class="fas fa-newspaper" style="font-size: 3rem; display: block; margin-bottom: 15px; opacity: 0.2;"></i>
                        Belum ada berita yang ditulis.
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
                title: 'Hapus Berita?',
                text: "Artikel ini akan dihapus secara permanen!",
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
