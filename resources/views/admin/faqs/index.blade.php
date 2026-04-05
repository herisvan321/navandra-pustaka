@extends('admin.layouts.admin')

@section('title', 'FAQ Management')
@section('page_title', 'Daftar Tanya Jawab')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Daftar FAQ</h3>
        <a href="{{ route('admin.faqs.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah FAQ
        </a>
    </div>

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>Pertanyaan</th>
                    <th>Jawaban</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($faqs as $faq)
                <tr>
                    <td style="max-width: 300px;">
                        <strong>{{ $faq->question }}</strong>
                    </td>
                    <td style="max-width: 400px;">
                        <span style="font-size: 0.85rem; color: var(--text-muted);">
                            {{ Str::limit($faq->answer, 150) }}
                        </span>
                    </td>
                    <td>
                        <span class="label {{ $faq->is_active ? 'label-success' : 'label-gray' }}">
                            {{ $faq->is_active ? 'Aktif' : 'Non-aktif' }}
                        </span>
                    </td>
                    <td>
                        <div style="display: flex; gap: 8px;">
                            <a href="{{ route('admin.faqs.edit', $faq->id) }}" class="action-btn" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.faqs.destroy', $faq->id) }}" method="POST" class="delete-form" style="display: inline;">
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
                    <td colspan="4" style="text-align: center; padding: 50px 0; color: var(--text-muted);">
                        <i class="fas fa-question-circle" style="font-size: 3rem; display: block; margin-bottom: 15px; opacity: 0.2;"></i>
                        Belum ada daftar FAQ.
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
                title: 'Hapus FAQ?',
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
