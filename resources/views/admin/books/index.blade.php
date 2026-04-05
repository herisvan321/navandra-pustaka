@extends('admin.layouts.admin')

@section('title', 'Manajemen Buku')
@section('page_title', 'Daftar Buku')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Daftar Buku</h3>
        <a href="{{ route('admin.books.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Buku
        </a>
    </div>

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>Cover</th>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Kategori</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($books as $book)
                <tr>
                    <td>
                        @if($book->cover_image)
                            <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}" class="img-thumbnail-book">
                        @else
                            <div class="img-thumbnail-book" style="display: flex; align-items: center; justify-content: center; background: var(--bg-body);">
                                <i class="fas fa-book" style="color: var(--text-muted); opacity: 0.5;"></i>
                            </div>
                        @endif
                    </td>
                    <td><strong>{{ $book->title }}</strong></td>
                    <td>{{ $book->author }}</td>
                    <td>{{ $book->category }}</td>
                    <td>
                        @php
                            $statusLabel = [
                                'available' => ['class' => 'label-success', 'text' => 'Tersedia'],
                                'out_of_stock' => ['class' => 'label-warning', 'text' => 'Habis'],
                                'pre_order' => ['class' => 'label-info', 'text' => 'Pre-Order'],
                                'published' => ['class' => 'label-success', 'text' => 'Published'],
                                'draft' => ['class' => 'label-warning', 'text' => 'Draft'],
                            ];
                            $curr = $statusLabel[$book->status] ?? ['class' => 'label-gray', 'text' => $book->status];
                        @endphp
                        <span class="label {{ $curr['class'] }}">
                            {{ $curr['text'] }}
                        </span>
                    </td>
                    <td>
                        <div style="display: flex; gap: 8px;">
                            <a href="{{ route('admin.books.edit', $book->id) }}" class="action-btn" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.books.destroy', $book->id) }}" method="POST" class="delete-form" style="display: inline;">
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
                        <i class="fas fa-book-open" style="font-size: 3rem; display: block; margin-bottom: 15px; opacity: 0.2;"></i>
                        Belum ada data buku.
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
                title: 'Hapus Buku?',
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
