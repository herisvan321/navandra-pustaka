@extends('admin.layouts.admin')

@section('title', 'Galeri Foto')
@section('page_title', 'Daftar Foto')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Koleksi Foto</h3>
        <a href="{{ route('admin.gallery.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Foto
        </a>
    </div>

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>Foto</th>
                    <th>Judul & Ket.</th>
                    <th>Tipe</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($gallery as $item)
                <tr>
                    <td>
                        @if($item->image_path)
                            <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->title }}" style="width: 100px; height: 60px; object-fit: cover; border-radius: 5px; cursor: pointer;" onclick="window.open(this.src)">
                        @else
                            <div style="width: 100px; height: 60px; background: var(--border-color); border-radius: 5px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-image" style="color: var(--text-muted);"></i>
                            </div>
                        @endif
                    </td>
                    <td>
                        <strong>{{ $item->title }}</strong>
                        <div style="font-size: 0.8rem; color: var(--text-muted); max-width: 250px;">
                            {{ Str::limit($item->description, 60) }}
                        </div>
                    </td>
                    <td>
                        <span class="label" style="background: var(--bg-body); color: var(--text-main); border: 1px solid var(--border-color);">
                            {{ ucfirst($item->type) }}
                        </span>
                    </td>
                    <td>{{ $item->event_date ? \Carbon\Carbon::parse($item->event_date)->format('d M Y') : '-' }}</td>
                    <td>
                        <div style="display: flex; gap: 8px;">
                            <a href="{{ route('admin.gallery.edit', $item->id) }}" class="action-btn" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.gallery.destroy', $item->id) }}" method="POST" class="delete-form" style="display: inline;">
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
                        <i class="fas fa-images" style="font-size: 3rem; display: block; margin-bottom: 15px; opacity: 0.2;"></i>
                        Belum ada koleksi foto.
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
                title: 'Hapus Foto?',
                text: "Item galeri ini akan dihapus secara permanen!",
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
