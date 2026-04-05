@extends('admin.layouts.admin')

@section('title', 'Detail Pesan')

@section('page_title', 'Pesan Masuk')

@section('content')
<div class="content-header" style="margin-bottom: 25px;">
    <div style="display: flex; align-items: center; gap: 15px;">
        <a href="{{ route('admin.contacts.index') }}" class="btn" style="background: var(--bg-card); color: var(--text-main); padding: 10px 15px;">
            <i class="fas fa-arrow-left"></i>
        </a>
        <h2 style="font-size: 1.5rem; font-weight: 700;">Baca Pesan</h2>
    </div>
</div>

<div class="card" style="max-width: 800px; margin: 0 auto; padding: 30px;">
    <div style="display: flex; justify-content: space-between; border-bottom: 1px solid var(--border-color); padding-bottom: 20px; margin-bottom: 25px;">
        <div>
            <h3 style="font-size: 1.25rem; font-weight: 700;">{{ $message->subject }}</h3>
            <div style="color: var(--text-muted); font-size: 0.9rem; margin-top: 5px;">
                <i class="fas fa-user-circle"></i> {{ $message->name }} &lt;{{ $message->email }}&gt;
            </div>
        </div>
        <div style="text-align: right; color: var(--text-muted); font-size: 0.85rem;">
            <div>{{ $message->created_at->format('d M Y') }}</div>
            <div>{{ $message->created_at->format('H:i') }} WIB</div>
        </div>
    </div>

    <div style="line-height: 1.8; color: var(--text-main); font-size: 1rem; min-height: 150px; background: var(--bg-body); padding: 20px; border-radius: 8px;">
        {!! nl2br(e($message->message)) !!}
    </div>

    <div style="display: flex; gap: 15px; justify-content: flex-end; margin-top: 40px; padding-top: 20px; border-top: 1px solid var(--border-color);">
        <form action="{{ route('admin.contacts.destroy', $message->id) }}" method="POST" id="deleteForm">
            @csrf
            @method('DELETE')
            <button type="button" class="btn" style="background: #ef4444; color: white;" id="deleteBtn">Hapus Pesan</button>
        </form>
        <a href="mailto:{{ $message->email }}" class="btn btn-primary" style="padding: 12px 25px;">Balas via Email</a>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.getElementById('deleteBtn').addEventListener('click', function() {
        Swal.fire({
            title: 'Hapus Pesan?',
            text: "Pesan ini akan dihapus permanen dari sistem.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Ya, Hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('deleteForm').submit();
            }
        });
    });
</script>
@endsection
