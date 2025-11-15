@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">History WhatsApp</h2>

    @if (session('status'))
        <div class="alert alert-info">{{ session('status') }}</div>
    @endif

    <div class="mb-3">
        <a href="{{ route('notifikasi.create') }}" class="btn btn-primary">Kirim WA Baru</a>
    </div>

    <div class="card">
        <div class="card-body p-0">
            <table class="table table-striped mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Waktu</th>
                        <th>Nomor</th>
                        <th>Pesan</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                @forelse ($messages as $msg)
                    <tr>
                        <td>{{ $loop->iteration + ($messages->currentPage()-1)*$messages->perPage() }}</td>
                        <td>{{ $msg->sent_at?->format('Y-m-d H:i') ?? $msg->created_at->format('Y-m-d H:i') }}</td>
                        <td>{{ $msg->phone }}</td>
                        <td style="max-width: 350px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                            {{ $msg->message }}
                        </td>
                        <td>
                            @if ($msg->status === 'success')
                                <span class="badge bg-success">Success</span>
                            @elseif ($msg->status === 'failed')
                                <span class="badge bg-danger">Failed</span>
                            @else
                                <span class="badge bg-secondary">{{ $msg->status ?? 'N/A' }}</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center p-4">Belum ada pesan yang dikirim.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        @if ($messages->hasPages())
            <div class="card-footer">
                {{ $messages->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
