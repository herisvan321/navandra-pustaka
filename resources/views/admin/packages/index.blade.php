@extends('admin.layouts.admin')

@section('title', 'Paket Penerbitan')
@section('page_title', 'Daftar Paket')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Paket Tersedia</h3>
        <a href="{{ route('admin.packages.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Paket
        </a>
    </div>

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>Nama Paket</th>
                    <th>Harga</th>
                    <th>Fitur</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($packages as $package)
                <tr>
                    <td>
                        <strong>{{ $package->name }}</strong>
                        @if($package->is_featured)
                            <span class="label label-info" style="font-size: 0.65rem; margin-left: 5px;">BEST</span>
                        @endif
                    </td>
                    <td>Rp {{ number_format($package->price, 0, ',', '.') }}</td>
                    <td>
                        @php
                            $features = is_string($package->features) ? json_decode($package->features) : $package->features;
                        @endphp
                        @if($features)
                            <ul style="padding-left: 15px; font-size: 0.85rem; color: var(--text-muted); margin: 0;">
                                @foreach(array_slice((array)$features, 0, 2) as $f)
                                    <li>{{ $f }}</li>
                                @endforeach
                                @if(count((array)$features) > 2)
                                    <li>... ({{ count((array)$features) - 2 }} lainnya)</li>
                                @endif
                            </ul>
                        @endif
                    </td>
                    <td>
                        <span class="label {{ $package->is_featured ? 'label-success' : 'label-gray' }}">
                            {{ $package->is_featured ? 'Featured' : 'Standard' }}
                        </span>
                    </td>
                    <td>
                        <div style="display: flex; gap: 8px;">
                            <a href="{{ route('admin.packages.edit', $package->id) }}" class="action-btn" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.packages.destroy', $package->id) }}" method="POST" class="delete-form" style="display: inline;">
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
                        <i class="fas fa-box-open" style="font-size: 3rem; display: block; margin-bottom: 15px; opacity: 0.2;"></i>
                        Belum ada paket penerbitan.
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
                title: 'Hapus Paket?',
                text: "Data paket ini akan dihapus secara permanen!",
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
