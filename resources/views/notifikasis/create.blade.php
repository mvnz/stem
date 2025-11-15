@extends('layouts.app') {{-- atau layout yang kamu pakai --}}

@section('content')
<div class="container">
    <h2 class="mb-4">Kirim WhatsApp (Fonnte)</h2>

    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <form action="{{ route('notifikasi.store') }}" method="POST" class="card p-4">
        @csrf

        <div class="mb-3">
            <label for="no_hp" class="form-label">Nomor Tujuan (format 62...)</label>
            <input type="text" name="no_hp" id="no_hp"
                   class="form-control @error('no_hp') is-invalid @enderror"
                   value="{{ old('no_hp') }}" placeholder="62812xxxxxxx">
            @error('no_hp')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="message" class="form-label">Pesan</label>
            <textarea name="message" id="message" rows="4"
                      class="form-control @error('message') is-invalid @enderror"
                      placeholder="Tulis pesan WhatsApp...">{{ old('message') }}</textarea>
            @error('message')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button class="btn btn-primary">Kirim WA</button>
        <a href="{{ route('notifikasi.index') }}" class="btn btn-outline-secondary ms-2">Lihat History</a>
    </form>
</div>
@endsection
